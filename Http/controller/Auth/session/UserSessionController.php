<?php

namespace Http\controller\Auth\session;

use core\Session;
use core\Authenticator;
use Http\forms\Validation;
use Http\model\User\Users;
use Http\model\dept\Subject;
use Http\controller\Controller;
use Http\model\dept\ClassModel;

class UserSessionController extends Controller
{
    // ----------------------------------------------------------

    # This controller roles and functions of auth user of the system
    # Users are handled and assign needed roles in this file.

    // ---------------------------------------------------------


    public function index()
    {

    // =============================================
        # load a view on a user details for assigning
        # the user as a teaching subject user.
    // =============================================

        return view('session/session.view/roles.view', [
            'errors' => Session::get('errors'),
            'title' => 'Subject Teacher',
            'classes' => Users::subjects($_GET['username']),
            'user' => Users::getUser($_GET['id']),
        ]);
    }

    public function store() 
    {

    // =====================================================
        # save the operational action under the 
        # selected user. 

        # make neccessary validation for existing reords 
        # for the user in question                         
    // ====================================================
    
        $request = Validation::validate($data = [
            'username' => $_POST['username'],
            'Subject_code' => $_POST['Subject_code'],    
            'class_code' => $_POST['class_code'],
            'created_at' => cur_time(),
            'maker' => Session::user(),
            'make_at' => cur_time()
        ],
        [
            'Subject_code' => 'required',
            'class_code' => 'required'
        ]);

        if (Subject::subjCodeConfirmed($data['Subject_code'])) {
            $request->error(
                'Subject_code', 'UNCONFIRMED subject code.'
            )->throw();
        }

        if (ClassModel::classCodeConfirm($data['class_code'])) {
            $request->error(
                'class_code', 'UNCONFIRMED class code.'
            )->throw(); 
        }

        if (ClassModel::teacherCodeClass($data['username'], $data['class_code'], $data['Subject_code'])) {
            $request->error(
                'class_code', 'Record exist for this user.'
            )->throw(); 
        }

        if (! Subject::subjCodeExist($data['Subject_code'])) {
            $request->error(
                'Subject_code', 'No Subject found with the code value.'
            )->throw();  
        }

        if (! ClassModel::classCodeExist($data['class_code'])) { 
            $request->error(
                'class_code', 'No class found with the code value.'
            )->throw();
        }
        
        Authenticator::save('subj_teacher', $data);

        Session::flash('success', "Subject for a class has been assigned to the {$data['username']} successfully");
        redirect('/session/summary?id='. $_POST['id']);
    }

}