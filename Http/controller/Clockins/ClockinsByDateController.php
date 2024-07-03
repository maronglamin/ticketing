<?php

namespace Http\controller\Clockins;

use core\Session;
use core\Response;
use core\Paginator;
use core\Authenticator;
use Http\forms\Validation;
use Http\model\ClockinsModel;
use Http\controller\Controller;

class ClockinsByDateController extends Controller
{
    public function index()
    {
        return view('clock-ins/clockins.dates.view', [
            'title' => 'Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'Clockins By Date',
            'instruction' => 'Search clockins by date.',
        ]);
    }

    public function search()
    {
        return view('clock-ins/clockins.search.view', [
            'title' => 'Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'Search filters for Clockins By Date',
            'instruction' => 'Search result for clockins by date.',
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('smart_hr_clock_ins'),
            'pages' => Paginator::pages('smart_hr_clock_ins'),
            'ClockedUsers' => ClockinsModel::getListByDate(sanitize($_POST['month_year'])),
        ]);
    }

    public function showByDate()
    {
        return view('clock-ins/clockins.bydate.trackings.view', [
            'title' => 'By Date Clockins',
            'errors' => Session::get('errors'),
            'heading' => 'By date attendance',
            'instruction' => 'Make quick actions on the staff attendance for a custom date',
            'user' => ClockinsModel::getByDateClockin(sanitize($_GET['date']), sanitize($_GET['tracking'])),
        ]);
    }

    public function saveByDate()
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
        return redirect('/clock-ins/clockins.dates.view');

        // route('clock-ins/byDateReactions?tracking='. $value['username'] .'&date='. $value['month_year'])
        // clockin search view url.
    }
}