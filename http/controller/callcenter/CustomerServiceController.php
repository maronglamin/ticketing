<?php

namespace http\controller\callcenter;

use core\Session;
use core\Paginator;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\controller\Controller;
use http\model\callCenter\CallCenterModel;

class CustomerServiceController extends Controller
{
    public function index()
    {
        return ExternalView('callcenter/index.view', [
            'title' => 'Call Center',
            'errors' => Session::get('errors'),
            'ticketing_id' => ModelData::getLastInsertedID('aps_call_center'),
            'callReason' => CallCenterModel::getCategory('call_reason'),
            'transactionType' => CallCenterModel::getCategory('transaction_type'),
            'paginate' => CallCenterModel::getCallPaginator(),
            'complaints' => CallCenterModel::getCallCategory('COMPLAINT'),
            'enquiry' => CallCenterModel::getCallCategory('ENQUIRY'),
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_call_center'),
            'pages' => Paginator::pages('aps_call_center'),
            'ticketLists' => CallCenterModel::getCallTickets('aps_call_center', Paginator::start())

        ]);
    }

    public function store()
    {
        $instance = Validation::validate($data = [
            'reasonForCall' => sanitize($_POST['reasonForCall']),
            'transactionType' => sanitize($_POST['transactionType']), 
            'customerName' => sanitize($_POST['customerName']), 
            'phoneNumber' => sanitize($_POST['phoneNumber']), 
            'description' => sanitize($_POST['description']), 
            'ticketId' => sanitize($_POST['ticketId']), 
            'email' => sanitize($_POST['email']), 
            'ticket_channel' => sanitize($_POST['ticket_channel']), 
            'created_at' => cur_time(),
            'maker_id' => Session::user()
        ],
        [
            'reasonForCall' => 'required',
            'transactionType' => 'required',
            'description' => 'required'
        ]);

        
        Authenticator::save('aps_call_center', $data);
                
        Session::flash('success', 'Details From a Customer LOGGED successfully');
        return redirect('/callcenter/logs');
        
    }

}