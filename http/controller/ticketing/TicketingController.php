<?php

namespace http\controller\ticketing;

use core\Session;
use core\Response;
use core\Paginator;
use core\UploadImg;
use core\MailSender;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\model\TicketingModel;
use http\controller\Controller;
use http\model\mobifin\MPRmodel;

class TicketingController extends Controller
{
    public function index()
    {
        return view('ticketing/index.view', [
            'title' => 'Request Ticketing',
            'errors' => Session::get('errors'),
            'heading' => 'Aps Wallet IT Request',
            'instruction' => 'The ticket history',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_ticketing'),
            'pages' => Paginator::pages('aps_ticketing'),
            'data' => MPRmodel::getLITS('aps_ticketing', Session::user(), Paginator::start()),
            
        ]);
    }

    public function adminIndex()
    {
        return view('ticketing/admin/index.view', [
            'title' => 'Request Ticketing',
            'errors' => Session::get('errors'),
            'heading' => 'HelpDesk Request',
            'instruction' => 'The ticket history',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_ticketing'),
            'pages' => Paginator::pages('aps_ticketing'),
            'data' => ModelData::getall('aps_ticketing', Paginator::start()),
            
        ]);
    }

    public function newTicket()
    {
        return view('ticketing/new.ticket.view', [
            'title' => 'New Ticket Request',
            'errors' => Session::get('errors'),
            'heading' => 'New IT Request',
            'instruction' => 'Send a new ticket request',
            'ticketing_id' => ModelData::getLastID('aps_ticketing')
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
            'priority' => ($_POST['priority']),
            'email' => ($_POST['email']),
            'ticket_channel' => ($_POST['ticket_channel']),
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
        
        // MailSender::sendEmail(ModelData::addUserEmail(), 'APS Wallet Ticketing_id: '. $data['ticketId'], 'view/template/mailTemplate.php');
        
        Session::flash('success', 'Request sent successfully');
        return redirect('/ticketing');
        

    }

    public function status()
    {
        $ticket_id = sanitize($_GET['ticketing']);

        return view('ticketing/status.ticket.view', [
            'title' => 'Ticket Status',
            'errors' => Session::get('errors'),
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getTicket(Session::user(), $ticket_id)
        ]);
    }

    public function adminStatus()
    {
        return view('ticketing/admin/status.ticket.view', [
            'title' => 'Ticket Status',
            'errors' => Session::get('errors'),
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getAllTicket(sanitize($_GET['ticketing']))
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
            'classification' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'department' => 'required',
            'status' => 'required',
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
            // MailSender::sendEmail(sanitize($_POST['email']), 'APS Wallet Ticketing_id: '. sanitize($_POST['ticketId']), 'view/template/resolved.php');

        } elseif ($data['status'] === 'Closed') {
            $data['ticket_closed_at'] = cur_time();
        } elseif ($data['status'] === 'Cancel') {
            $data['ticket_cancel_at'] = cur_time();
        } else {
            $data['status'];
        }

        Authenticator::commit('aps_ticketing', sanitize($_POST['id']), $data);  


        // if (! ModelData::AssignExist('aps_ticketing', sanitize($_POST['id']))) {
            // MailSender::sendEmail($data['ticket_assigned_to'], 'APS Wallet Ticketing_id: '. sanitize($_POST['ticketId']), 'view/template/ticketAssigned.php');
        // }
        
        Session::flash('success', 'Ticket details updated successfully');
        return redirect('/admin/status/ticket?ticketing='. sanitize($_POST['id']));
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
