<?php

namespace Http\controller\dashboard;

use core\Session;
use Http\controller\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard/index.view', [
            'errors' => Session::get('errors'),
            'title' => 'Dashboard',

        ]);
    }

}