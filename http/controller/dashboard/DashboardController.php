<?php

namespace http\controller\dashboard;

use core\Session;
use http\controller\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index.view', [
            'errors' => Session::get('errors'),
            'title' => 'Dashboard',

        ]);
    }

}