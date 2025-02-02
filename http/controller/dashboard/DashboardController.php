<?php

namespace http\controller\dashboard;

use core\Session;
use core\Response;
use core\Paginator;
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
            'bannerHeader' => 'Welcome to APS Ticketing System',
            'tagline' => 'Efficiently manage your request and follow-ups',
            'departmentCount' => DashboardModel::getDeptTicketCount(Session::department()),
            'userCount' => DashboardModel::getUserTicketCount(Session::user(), Response::NOT_SOFT_DELETED),
            'pendingCount' => DashboardModel::getUserTicketPendingCount(Session::user()),
            'escalateCount' => DashboardModel::getUserTicketEscalatedCount(Session::user()),
            'deptResolved' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_RESOLVED),
            'deptNew' => DashboardModel::getTicketStatusCount(Session::department(), Response::STATUS_NEW),
            'page' => TicketDeptPagination::page(),
            'start' => TicketDeptPagination::start(),
            'records' => TicketDeptPagination::paginate(),
            'pages' => TicketDeptPagination::pages(),
            'data' => MPRmodel::getLITS('aps_ticketing', Session::department(), TicketDeptPagination::start()),
        ]);
    }

}