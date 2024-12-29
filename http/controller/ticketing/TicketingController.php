<?php

namespace http\controller\ticketing;

use core\Session;
use core\Response;
use core\Paginator;
use core\UploadImg;
use core\JsonGenerate;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\model\DashboardModel;
use http\model\TicketingModel;
use http\controller\Controller;
use http\model\DepartmentModel;
use http\model\mobifin\MPRmodel;
use http\model\RequestTypeModel;
use customs\TicketDeptPagination;

class TicketingController extends Controller
{
    public function index()
    {
        return view('ticketing/index.view', [
            'title' => 'Request Ticketing',
            'errors' => Session::get('errors'),
            'heading' => 'APS e-Ticketing',
            'instruction' => 'The eTicket history for you and your department logs will be displayed below. You can also request a new ticket by clicking the button below.',
            'page' => TicketDeptPagination::page(),
            'start' => TicketDeptPagination::start(),
            'records' => TicketDeptPagination::paginate(),
            'pages' => TicketDeptPagination::pages(),
            'data' => MPRmodel::getLITS('aps_ticketing', Session::department(), TicketDeptPagination::start()),
            
        ]);
    }
    
    public function adminIndex()
    {
        return view('ticketing/admin/index.view', [
            'title' => 'Request Ticketing',
            'errors' => Session::get('errors'),
            'heading' => 'HelpDesk Request',
            'instruction' => 'All tickets raise by users will be displayed below. adjust the ticket detils to the categories and classifications.',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_ticketing'),
            'pages' => Paginator::pages('aps_ticketing'),
            'data' => ModelData::getall('aps_ticketing', Paginator::start()),
            
        ]);
    }

    public function newTicket()
    {
        return view('ticketing/raise.view', [
            'title' => 'New Ticket Request',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Raise a New Ticket',
            'tagline' => 'Make a new ticket request here and monitor the status over time.',
            'departmentCount' => DashboardModel::getDeptTicketCount(Session::department()),
            'userCount' => DashboardModel::getUserTicketCount(Session::user(), Response::NOT_SOFT_DELETED),
            'deptResolved' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_RESOLVED),
            'deptNew' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_NEW),
            'heading' => 'New IT Request',
            'instruction' => 'Send a new ticket request',
            'ticketing_id' => ModelData::getLastID('aps_ticketing'),
            'dept' => DepartmentModel::getDepartment(),
            'ownDept' => DepartmentModel::getDepartmentByEntity(),
            'parent' => RequestTypeModel::getParent(),
            'child' => RequestTypeModel::getChild(),

        ]);
    }

    public function store() 
    {
        $instance = Validation::validate($data = [
            'classification' => sanitize($_POST['classification']),
            'category' => sanitize($_POST['category']), 
            'sub_category' => sanitize($_POST['sub_category']),       
            'department' => sanitize($_POST['department']),
            'discription' => sanitize($_POST['discription']),
            'ticketId' => sanitize($_POST['ticketId']),
            'make_at' => cur_time(),
            'maker_id' => Session::user(),
            'host' => ($_POST['host']),
            'upload_file' => sanitize($_POST['']),
            'priority' => sanitize($_POST['priority']),
            'email' => sanitize($_POST['email']),
            'ticket_channel' => sanitize($_POST['ticket_channel']),
        ],
        [
            'classification' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'department' => 'required',
            'discription' => 'required',
            'priority' => 'required'
        ]);

        $data['file_path'] = UploadImg::saveFile($instance);

        if (TicketingModel::getTicketId($data['ticketId'])) {

            $instance->error(
                'classification', 'TICKET ID for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        
        Authenticator::save('aps_ticketing', $data); 
                
        Session::flash('success', 'Request sent successfully');
        return redirect('/ticketing');
        

    }

    public function status()
    {
        $ticket_id = sanitize($_GET['ticketing']);

        return view('ticketing/details.view', [
            'title' => 'Ticket Status',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Ticket Details',
            'tagline' => 'View and update the details of your ticket',
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getTicket($ticket_id),
        ]);
    }

    public function adminStatus()
    {
        return view('ticketing/admin/status.ticket.view', [
            'title' => 'Ticket Status',
            'errors' => Session::get('errors'),
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getAllTicket(sanitize($_GET['ticketing'])),
            'parent' => RequestTypeModel::getParent(),
            'child' => RequestTypeModel::getChild(),
            'dept' => DepartmentModel::getDepartment()
            
        ]);
    }

    public function update()
    {
        Validation::validate($data = [
            'classification' => sanitize($_POST['classification']),
            'category' => sanitize($_POST['category']), 
            'sub_category' => sanitize($_POST['sub_category']),       
            'department' => sanitize($_POST['department']),
            'discription' => sanitize($_POST['discription']),
            'status' => sanitize($_POST['status']),
            'ticket_resolved_by' => sanitize($_POST['ticket_resolved_by']),
            'ticket_assigned_to' => sanitize($_POST['ticket_assigned_to']),
            'priority' => sanitize($_POST['priority']),
        ],
        [
            'discription' => 'required'
        ]);

        if ($data['status'] === 'Assigned') {
            $data['ticket_assigned_at'] = cur_time();

        } elseif ($data['status'] === 'Working In Progress') {
            $data['ticket_working_in_at'] = cur_time();
        } elseif ($data['status'] === 'On Hold') {
            $data['ticket_on_hold_at'] = cur_time();

        } elseif ($data['status'] === 'Resolved') {
            $data['ticket_resolved_at'] = cur_time();

        } elseif ($data['status'] === 'Closed') {
            $data['ticket_closed_at'] = cur_time();
        } elseif ($data['status'] === 'Cancel') {
            $data['ticket_cancel_at'] = cur_time();
        } else {
            $data['status'];
        }

        Authenticator::commit('aps_ticketing', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Ticket details updated successfully');
        return redirect('/admin/status/ticket?ticketing='. sanitize($_POST['id']));
    }

    public function statusChange()
    {
        $comments = [
            'username' => Session::user(), 
            'comment' => sanitize($_POST['comment'])
        ];

        Validation::validate($data = [
            'status' => sanitize($_POST['status']),
            'comment' => JsonGenerate::encodeText($comments)
        ],
        [
            'status' => 'required',
        ]);

        $userComments = JsonGenerate::getEncodeText(sanitize($_POST['id']), 'comment');

        if (!empty($userComments)){
            if (json_last_error() === JSON_ERROR_NONE) {
                JsonGenerate::addComment($comments, 'comment', $userComments['comment']);
            }
        }

        if ($data['status'] === Response::STATUS_ASSIGED) {
            $data['ticket_assigned_at'] = cur_time();

        } elseif ($data['status'] === Response::STATUS_ONHOLD) {
            $data['ticket_on_hold_at'] = cur_time();

        } elseif ($data['status'] === Response::STATUS_RESOLVED) {
            $data['ticket_resolved_at'] = cur_time();

        } elseif ($data['status'] === Response::STATUS_CLOSED) {
            $data['ticket_closed_at'] = cur_time();
        } elseif ($data['status'] === Response::STATUS_ESCALATE) {
            $data['ticket_escalated_at'] = cur_time();
        } else {
            $data['status'];
        }

        Authenticator::commit('aps_ticketing', sanitize($_POST['id']), $data);  
        
        Session::flash('success', 'Ticket details updated successfully');
        return redirect('/status/ticket?ticketing='. sanitize($_POST['ticketid']));
    }

    public function destroy()
    {
        Authenticator::customCommit('aps_ticketing', 'ticketId', sanitize($_POST['ticket_id']), [
            'maker_id' => Session::user(),
            'make_at' => cur_time(),
            'soft_deleted' => Response::SOFT_DELETED,
            'last_updated_by' => cur_time(),
        ]); 

        Session::flash('success', 'Ticket deleted');
        return redirect('/admin/ticketing');

    }
}
