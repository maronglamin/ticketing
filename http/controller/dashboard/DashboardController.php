<?php

namespace http\controller\dashboard;

use core\Session;
use core\Response;
use http\model\DashboardModel;
use http\controller\Controller;
use http\model\mobifin\MPRmodel;
use customs\TicketDeptPagination;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index.view', [
            'errors' => Session::get('errors'),
            'title' => 'Dashboard',
            'departmentCount' => DashboardModel::getDeptTicketCount(Session::department()),
            'userCount' => DashboardModel::getUserTicketCount(Session::user(), Response::NOT_SOFT_DELETED),
            'deptResolved' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_RESOLVED),
            'deptNew' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_NEW),
            'data' => MPRmodel::getLITS('aps_ticketing', Session::department(), TicketDeptPagination::start()),

        ]);
    }

}