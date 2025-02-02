<?php

namespace http\controller\Auth\registration;

use core\Session;
use core\Authenticator;
use http\forms\LoginForm;
use http\forms\Validation;
use http\controller\Controller;


class RegisterController extends Controller 
{
    public function index()
    {
        return sessionSign('session/session.view/password.view',[
            'errors' => Session::get('errors'),
            'title' => 'Create user',
            'username' => text2cap($_GET['user']),
        ]);
    }
    public function create()
    {
        return sessionSign('registration/create.view',[
            'errors' => Session::get('errors'),
            'title' => 'Create user'
        ]);
    }

    public function store()
    {
        $form = LoginForm::validate($attributes = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);
        
        $register = Authenticator::create(
            $attributes['username'],
            $attributes['password']
        );
        
        if (! $register) {
            $form->error(
                'username', 'User already exist'
            )->throw();
        }

        Session::flash('success', 'The user '. $attributes['username']. ' is created successfully');
        return redirect('/');
    }

    public function update()
    {

        $request = Validation::validate($data = [
            'password' => $_POST['password'],
            'password_confirmed' => $_POST['password_confirmed'],
        ],

        [
            'password' => 'required',
            'password_confirmed' => 'required',
            
        ]);

        if ($data['password'] !== $data['password_confirmed'])
        {
            $request->error(
                'password', 'The password and confirmation do not match.'
            )->throw();
        }

        Authenticator::customCommit('users', 'username', $_POST['id'], [
            'password' => hashed($_POST['password']), 
            'password_updated_at' => cur_time()
        ]);  

        Authenticator::logout();
        return redirect('/session/user/password?user='. $_POST['id']);
    }

}
