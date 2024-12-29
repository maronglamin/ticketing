<?php

namespace http\controller\Auth\session;

use core\Session;
use core\Response;
use core\Paginator;
use http\model\Model;
use core\Authenticator;
use http\forms\Validation;
use http\model\User\Users;
use http\controller\Controller;
use http\model\DepartmentModel;
use http\model\EntityModel;

class SignedController extends Controller
{
    public function index()
    {   
        return view('session/users.view', [
            'errors' => Session::get('errors'),
            'title' => 'Users',
            'bannerHeader' => 'User List',
            'tagline' => 'Manage user accounts',
            'heading' => 'User Summary',
            'instruction' => 'System users',
            'data' => Response::PAGE_RECORD,
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('users'),
            'pages' => Paginator::pages('users'),
            'users' => Model::data('users', Paginator::start())
        ]);
    }

    public function edit()
    {
        return view('session/user.summary.view', [
            'user' => Users::getUser($_GET['id']),
            'title' => 'Edit user',
            'bannerHeader' => 'Modify User',
            'tagline' => 'Modify or update user details',
            'dept' => DepartmentModel::getDepartmentByEntity(),
            'depts' => DepartmentModel::getDepartment(),
            'entity' => EntityModel::getEntity(),
            'errors' => Session::get('errors')
        ]);
    }

    public function search()
    {
        Validation::validate([
            'confirmed' => $_POST['confirmed']
        ],

        [
            'confirmed' => 'required'
        ]);
        
        return view('session/users.view', [
            'errors' => Session::get('errors'),
            'heading' => 'User Summary',
            'instruction' => 'Search system users with Query parameters',
            'search' => Authenticator::get()
                    ->query("SELECT id, confirmed, username, name  FROM users WHERE confirmed = :confirmed or username = :username or name = :name", [
                    'username' => $_POST['username'],
                    'confirmed' => $_POST['confirmed'],
                    'name' => $_POST['name']
                    ])->findOrFail(),
            ]);
    }

    public function save()
    {
        $user = Authenticator::findById('users',  $_POST['id'])->find();
        Validation::validate($data = [
            'maker' => Session::user(),
            'make_at' => cur_time(),
            'checker' => '',
            'checker_at' => '',
            'confirmed' => Response::UNAUTHORISD,
            'username' => $_POST['username'],
            'auto_auth' => $_POST['auto'],
            'user_status_change' => ($_POST['status'] !== '')? cur_time() : $user['user_status_change'],
            'user_status' => ($_POST['status'] === '')? $user['user_status']: $_POST['status'], 
            'password_updated_at' => ($_POST['password'] !== '')? cur_time() : $user['password_updated_at'],
            'password' => ($_POST['password'] === '')? $user['password']: hashed($_POST['password']),
            'email' => ($_POST['email'] === '')? $user['email']: $_POST['email'],
            'name' => ($_POST['name'] === '')? $user['name']: $_POST['name'],
            'department' => $_POST['department'], 
            'user_role' => $_POST['user_role'], 
            'aps_entity' => $_POST['entity_name'], 
            'aps_bankPayer' => $_POST['aps_bankPayer'], 

        ], 

        [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'user_role' => 'required',
        ]);

        Authenticator::commit('users', $_POST['id'], $data);

        Session::flash('success', 'User information updated');

        return redirect('/session/users');

    }

    public function store()
    {
        $request = Validation::validate($user = [
            'username' => $_POST['username'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'auto_auth' => $_POST['auto'],
            'user_status' => $_POST['user_status'],
            'password' => hashed($_POST['password']),
            'maker' => Session::user(),
            'make_at' => cur_time(),
        ],

        [
            'username' => 'required',
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        # check for username in the database

        if ( Authenticator::user($user['username'])) { 
            $request->error(
                'username', 'Username already exist'
            )->throw();
        }

        Authenticator::save('users', $user);
        Session::flash('success', 'User Created');

        return redirect('/session/maintenance');
    }

    public function create()
    {
        return view('session/create.view', [
            'errors' => Session::get('errors'),
            'title' => 'Dashboard',
            'bannerHeader' => 'User registeration',
            'tagline' => 'Create a new user of the system',
        ]);
    }

    public function update()
    {
        Authenticator::commit('users', $_POST['id'], [
            'checker' => Session::user(),
            'checker_at' => cur_time(),
            'confirmed' => Response::AUTHORISD
        ]); 

        Session::flash('success', 'User authorized');
        return redirect('/session/summary?id='. $_POST['id']);

    }

    public function destroy()
    {
        Authenticator::customCommit('users', 'username', $_POST['username'], [
            'checker' => Session::user(),
            'checker_at' => cur_time(),
            'confirmed' => Response::AUTHORISD,
            'soft_deleted' => Response::SOFT_DELETED,
            'user_status' => Response::STATUS_NEW_USER,
            'updated_at' => cur_time(),
        ]); 

        Session::flash('success', 'User Archived');
        return redirect('/session/users');

    }
}
