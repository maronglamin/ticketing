<?php

namespace http\controller\ticketing;

use core\Session;
use core\UploadImg;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\model\TicketingModel;
use http\controller\Controller;


class TicketDetails extends Controller
{
    public function index()
    {
        $id = sanitize($_GET['ticket']);

        return view('ticketing/details/index.view', [
            'title' => 'Ticket Status',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Ticket Details',
            'tagline' => 'View and update the details of your ticket',
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getTicket($id),
            'ticket_comments' => TicketingModel::getComments($id),
        ]);
    }

    public function agentLogs()
    {
        $id = sanitize($_GET['change']);

        return view('ticketing/details/agent.logs.detail.view', [
            'title' => 'Agent Ops Status Changes',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Log Details',
            'tagline' => 'View and update the details of your log',
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getAgentLogs($id),
            'ticket_comments' => TicketingModel::getComments($id),
        ]);
    }

    public function callCenterLogs()
    {
        $id = sanitize($_GET['change']);

        return view('ticketing/details/callcenter.logs.detail.view', [
            'title' => 'CCR Status Changes',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Log Details',
            'tagline' => 'View and update the details of your log',
            'heading' => 'Ticket Status',
            'instruction' => 'View ticket status',
            'ticket_detail' => TicketingModel::getCallcenterLogs($id),
            'ticket_comments' => TicketingModel::getComments($id),
        ]);
    }

    public function store() 
    {
        $instance = Validation::validate(
            $data = [
                'comment' => sanitize($_POST['comment']),
                'ticketId' => sanitize($_POST['ticketId']),
                'maker_id' => Session::user(),
                'email' => ModelData::addUserEmail(),
                'make_at' => cur_time(),
            ],
            [
                'comment' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveCommentFile(sanitize($_POST['ticketId']), $instance);
        
        Authenticator::save('ticket_comment', $data); 
                
        Session::flash('success', 'Commented on the ticket.');
        return redirect('/status/details?ticket='. sanitize($_POST['ticketId']));
        
    }

    public function storeComment() 
    {
        $instance = Validation::validate(
            $data = [
                'comment' => sanitize($_POST['comment']),
                'ticketId' => sanitize($_POST['ticketId']),
                'maker_id' => Session::user(),
                'email' => ModelData::addUserEmail(),
                'make_at' => cur_time(),
            ],
            [
                'comment' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveCommentFile(sanitize($_POST['ticketId']), $instance);
        
        Authenticator::save('ticket_comment', $data); 
                
        Session::flash('success', 'Commented on the ticket.');
        return redirect('/agent/operations/agentops/view/detail?change='. sanitize($_POST['ticketId']));
        
    }


    public function CallcenterStoreComment() 
    {
        $instance = Validation::validate(
            $data = [
                'comment' => sanitize($_POST['comment']),
                'ticketId' => sanitize($_POST['ticketId']),
                'maker_id' => Session::user(),
                'email' => ModelData::addUserEmail(),
                'make_at' => cur_time(),
            ],
            [
                'comment' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveCommentFile(sanitize($_POST['ticketId']), $instance);
        
        Authenticator::save('ticket_comment', $data); 
                
        Session::flash('success', 'Commented on the ticket.');
        return redirect('/callcenter/view/detail?change='. sanitize($_POST['ticketId']));
        
    }
}