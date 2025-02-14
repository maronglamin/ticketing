<?php

namespace http\controller\BIDashboards;

use core\Session;
use http\resource\view\Render;
use http\controller\Controller;

class BiDashboardController extends Controller
{
    public function index()
    {
        return Render::view('biReports.index', [
            'title' => 'Dashboards Reports',
            'errors' => Session::get('errors'),
            'pageName' => 'Dashboard',
        ]);
    }
}