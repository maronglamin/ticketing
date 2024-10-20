<?php

namespace http\controller;

use core\Session;
use core\Paginator;
use core\Authenticator;
use http\forms\Validation;
use http\controller\Controller;
use http\model\DepartmentModel;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department/index.view', [
            'title' => 'APS Departments',
            'errors' => Session::get('errors'),
            'heading' => 'Aps Department',
            'instruction' => 'All Department and their corresponding group email',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_department'),
            'pages' => Paginator::pages('aps_department'),
            'dept' => DepartmentModel::getDepartment()
            
        ]);
    }

    public function store()
    {

        $instance = Validation::validate($data = [
            'department_name' => sanitize($_POST['department_name']),
            'email' => sanitize($_POST['email']), 
            'created_at' => cur_time(),
            'maker_id' => Session::user()
        ],
        [
            'department_name' => 'required',
            'email' => 'required',
        ]);

        if(DepartmentModel::getEmail($data['email'])) {
            $instance->error(
                'email', 'That email exist for another department.'
            )->throw();
        }

        
        Authenticator::save('aps_department', $data); 
                
        Session::flash('success', 'Department Created successfully');
        return redirect('/department/list');
        

    }

}
