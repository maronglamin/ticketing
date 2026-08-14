<?php

namespace http\controller;

use core\Session;
use core\Response;
use core\DateTimeDiff;
use http\forms\Validation;
use http\model\DashboardModel;
use http\controller\Controller;
use http\model\BiReports\TicketingFilterModel;


class SearchTicketController extends Controller
{
    public function filter()
    {
        // var_dump($_POST); die();
        $instance = Validation::validate($data = [
            'status' => sanitize($_POST['status']),
            'priority' => sanitize($_POST['priority']),
            'ticketId' => sanitize($_POST['ticketId'])
        ],[]);

        return view('dashboard/index.view', [
            'title' => 'Filters',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Filtered ticket',
            'tagline' => "Your searched filtered List",
            'departmentCount' => DashboardModel::getDeptTicketCount(Session::department()),
            'userCount' => DashboardModel::getUserTicketCount(Session::user(), Response::NOT_SOFT_DELETED),
            'pendingCount' => DashboardModel::getUserTicketPendingCount(Session::user()),
            'deptResolved' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_RESOLVED),
            'deptNew' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_NEW),
            'filters' => TicketingFilterModel::getFilters(
                        $data['status'], 
                        $data['priority'],
                        $data['ticketId']),
            'export' => json_encode(TicketingFilterModel::getAllFilters(
                        $data['status'], 
                        $data['priority'],
                        $data['ticketId']))

        ]);
    }


}