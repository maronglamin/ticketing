<?php

namespace http\controller\ticketing;

use core\Response;
use http\controller\Controller;
use http\model\CheckListStatusModel;

class CheckStatusController  extends Controller
{
    public function newTicketStatus()
    {
        return view('ticketing/operations/check-list/new.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_NEW)
        ]);
    }
    
    public function onHoldTicketStatus()
    {
        return view('ticketing/operations/check-list/onhold.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_ONHOLD)
        ]);
    }

    public function resolvedTicketStatus()
    {
        return view('ticketing/operations/check-list/resolved.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_RESOLVED)
        ]);
    }
    public function inProgressTicketStatus()
    {
        return view('ticketing/operations/check-list/inprogress.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_IN_PROGRESS)
        ]);
    }
    public function closedTicketStatus()
    {
        return view('ticketing/operations/check-list/closed.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_RESOLVED)
        ]);
    }
    public function cancelledTicketStatus()
    {
        return view('ticketing/operations/check-list/cancelled.ticket.view', [
            'title' => 'Check Status',
            'heading' => 'New tickets',
            'message' => 'New Ticket Status in the system',
            'ticket' => CheckListStatusModel::getTickets(Response::STATUS_CANCELLED)
        ]);
    }
}
