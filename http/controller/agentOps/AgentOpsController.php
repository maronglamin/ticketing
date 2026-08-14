<?php

namespace http\controller\agentOps;

use core\Session;
use core\Paginator;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\controller\Controller;
use http\model\callCenter\CallCenterModel;

class AgentOpsController extends Controller
{
    public function index()
    {
        return view('agentOps/index.view', [
            'title' => 'Agent Operations',
            'bannerHeader' => 'Agents & ADR Logs',
            'tagline' => "Raise all queries against an Agent & ADR",
            'errors' => Session::get('errors'),
            'ticketing_id' => ModelData::getLastInsertedID('agent_ops'),
            'paginate' => CallCenterModel::getCallPaginator(),
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('agent_ops'),
            'pages' => Paginator::pages('agent_ops'),
            'ticketLists' => CallCenterModel::getAgentOpsTickets('agent_ops', Paginator::start())

        ]);
    }

    public function store()
    {
        $instance = Validation::validate($data = [
            'ticketId' => sanitize($_POST['ticketId']),
            'email' => sanitize($_POST['email']), 
            'issueCat' => sanitize($_POST['issueCat']), 
            'issueType' => sanitize($_POST['issueType']), 
            'reportedChannel' => sanitize($_POST['reportedChannel']), 
            'resolver' => sanitize($_POST['resolver']), 
            'ticket_channel' => sanitize($_POST['ticket_channel']), 
            'description' => sanitize($_POST['description']), 
            'created_at' => cur_time(),
            'maker_id' => Session::user()
        ],
        [
            'description' => 'required'
        ]);

        
        Authenticator::save('agent_ops', $data);
                
        Session::flash('success', 'Details logged successfully');
        return redirect('/agent/operations/logs');
        
    }

}