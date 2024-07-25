<?php

namespace http\controller\Auth\session;

use core\Session;
use core\Authenticator;
use http\forms\LoginForm;
use http\controller\Controller;


class SessionController extends Controller
{
    public function index()
    {
        return sessionSign('session/index.view', [
            'errors' => Session::get('errors'),
            'title' => 'Register'
        ]);
    }

    public function store()
    {
        $form = LoginForm::validate($attributes = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ]);
        
        Authenticator::restrictions($form, $attributes['username']);

        $signedIn = Authenticator::attempt(
            $attributes['username'],
            $attributes['password']
        );

        if (! $signedIn) {
            $form->error(
                'username', 'No matching username or password'
            )->throw();
        }

        return redirect('/dashboard');
    }

    public function destroy()
    {
        Authenticator::logout();
        return redirect('/');
    }
}