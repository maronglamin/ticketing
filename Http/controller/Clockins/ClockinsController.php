<?php

namespace Http\controller\Clockins;

use core\Session;
use core\Response;
use core\Paginator;
use core\Authenticator;
use Http\forms\Validation;
use Http\model\ClockinsModel;
use Http\controller\Controller;

class ClockinsController extends Controller
{
    public function index()
    {
        return view('clock-ins/clockin.view', [
            'title' => 'Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'Smart HR',
            'instruction' => 'Clock in before comencing official duties',
            'currentlyClocked' => ClockinsModel::getClockin(Session::user()),

        ]);
    }

    public function show()
    {
        return view('clock-ins/tracking.view', [
            'title' => 'Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'React to attendance',
            'instruction' => 'Make quick actions on the staff attendance',
            'user' => ClockinsModel::getClockin(sanitize($_GET['tracking'])),
        ]);
    }

    public function showPreciousDay()
    {
        return view('clock-ins/previous.tracking.view', [
            'title' => 'Previous Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'Previous day attendance',
            'instruction' => 'Make quick actions on the staff attendance for the previous day',
            'user' => ClockinsModel::getPreviousClockin(sanitize($_GET['tracking'])),
        ]);
    }

    public function clockout()
    {
        return view('clock-ins/clockout.view', [
            'title' => 'Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'Smart HR',
            'instruction' => 'Clock out before existing office',
            'currentlyClocked' => ClockinsModel::getClockin(Session::user()),

        ]);
    }

    public function list()
    {
        return view('clock-ins/track.view', [
            'title' => 'Listing clockins',
            'heading' => 'Monitor Clockins',
            'instruction' => 'Daily clockins of staff',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('smart_hr_clock_ins'),
            'pages' => Paginator::pages('smart_hr_clock_ins'),
            'currentListing' => ClockinsModel::getList(),

        ]);
    }
    
    public function previousDate()
    {
        return view('clock-ins/previous.clockins.view', [
            'title' => 'Listing clockins',
            'heading' => 'Monitor Clockins',
            'instruction' => 'Daily clockins of staff',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('smart_hr_clock_ins'),
            'pages' => Paginator::pages('smart_hr_clock_ins'),
            'previousListing' => ClockinsModel::getPreviousList(),

        ]);
    }

    public function store()
    {
        $request = Validation::validate($data = [
            'username' => Session::user(),
            'host_name' => sanitize($_POST['host_name']),
            'clock_in_at' => cur_time(),
            'month_year' => month_year(),
        ],[]);

        Authenticator::save('smart_hr_clock_ins', $data);  

        Session::flash('success', "Clock in successfully");
        return redirect('/clock-ins/in');
    }

    public function update()
    {
        Authenticator::commit('smart_hr_clock_ins', sanitize($_POST['id']), [
            'clock_out_at' => cur_time(),
            'clock_out_host' => sanitize($_POST['clock_out_host']),
        ]);  

        Session::flash('success', 'Clock out successfully');
        return redirect('/clock-ins/out');
    }

    public function save()
    {
        Validation::validate($data = [
            'clock_in_status' => sanitize($_POST['clock_in_status']),
            'expected_diff' => sanitize($_POST['expected_diff']),
        ],[
            'clock_in_status' => 'required',
        ]);

        Authenticator::doubleFieldUpdate('smart_hr_clock_ins', 'username', sanitize($_POST['username']), 'month_year', sanitize($_POST['month_year']), $data);
        Session::flash('success', 'User clockins updated');
        return redirect('/clock-ins/track');
    }

    public function savePreciousDay()
    {
        Validation::validate($data = [
            'clock_in_status' => sanitize($_POST['clock_in_status']),
            'clock_out_status' => sanitize($_POST['clock_out_status']),
            'expected_diff' => sanitize($_POST['expected_diff']),
            'expected_clockout_diff' => sanitize($_POST['expected_clockout_diff']),
        ],[
            'clock_in_status' => 'required',
            'clock_out_status' => 'required',
        ]);

        Authenticator::doubleFieldUpdate('smart_hr_clock_ins', 'username', sanitize($_POST['username']), 'month_year', sanitize($_POST['month_year']), $data);
        Session::flash('success', 'User clockins updated');
        return redirect('/clock-ins/track/previous');
    }

    public function destroy()
    {
        Authenticator::doubleFieldUpdate('smart_hr_clock_ins', 'username', sanitize($_POST['username']), 'month_year', sanitize($_POST['month_year']), [
            'soft_deleted_by' => Session::user(),
            'soft_deleted_at' => cur_time(),
            'soft_deleted' => Response::SOFT_DELETED,
            
        ]); 

        Session::flash('success', 'User clockins deleted');
        return redirect('/clock-ins/track');
    }
}