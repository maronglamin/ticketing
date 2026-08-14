<?php

namespace http\controller\BIDashboards;

use core\Session;
use core\Response;
use core\DateTimeDiff;
use core\Authenticator;
use http\forms\Validation;
use http\resource\view\Render;
use http\controller\Controller;
use http\model\BiReports\DetailReportModel;
use http\model\BiReports\SummaryReportModel;

class BiDashboardController extends Controller
{
    public function index()
    {
        return Render::view('biReports/index', [
            'title' => 'Dashboards Reports',
            'errors' => Session::get('errors'),
            'pageName' => 'Dashboard',
            'kpi' => SummaryReportModel::getKPIs(),
            'settleKPI' => SummaryReportModel::getSettlementKPIs(),
            'topAgentTrxnCount' => SummaryReportModel::getSettlementByCount(),
        ]);
    }

    public function export()
    {
        return Render::view('biReports/exportReport', [
            'title' => 'Export Transaction Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Export Data',
        ]);
    }

    public function createMoney() 
    {
        return Render::view('biReports/internal/create.money', [
            'title' => 'Create Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Create Money Transaction Report',
        ]);
    }
    public function addMoney()
    {
        return Render::view('biReports/internal/add.money', [
            'title' => 'Add Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Add Money Transaction Report',
        ]);
    }

    public function killMoney()
    {
        return Render::view('biReports/internal/kill.money', [
            'title' => 'Kill Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Kill Money Transaction Report',
        ]);
    }

    public function bankNote()
    {
        return Render::view('biReports/external/payment.instr', [
            'title' => 'Payment Note Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Payment Note Transaction Report',
        ]);
    }

    public function agentComulativeReport()
    {
        return Render::view('biReports/external/comulative.report', [
            'title' => 'Agent Settlement Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Agent Settlement Comulative Report',
        ]);
    }

    public function createSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/internal/create.money', [
            'title' => 'Create Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Create Money Transaction Report',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            'status' => $data['status'],
            'results' => DetailReportModel::getCreateMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status']),
            'export' => json_encode(DetailReportModel::getExportCreateMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status'])),
        ]);
    }

    public function addSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/internal/add.money', [
            'title' => 'Add Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Add Money Transaction Report',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            'status' => $data['status'],
            'results' => DetailReportModel::getAddMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status']),
            'export' => json_encode(DetailReportModel::getExportAddMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status'])),
        ]);
    }

    public function killSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            'status' => sanitize($_POST['status']),
        ],[
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/internal/kill.money', [
            'title' => 'Kill Money Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Kill Money Transaction Report',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            'status' => $data['status'],
            'results' => DetailReportModel::getKillMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status']),
            'export' => json_encode(DetailReportModel::getExportKillMoney(
                $data['startDate'], 
                $data['endDate'],
                $data['status'])),
        ]);
    }

    public function noteSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/external/payment.instr', [
            'title' => 'Bank Note Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Bank Note Transaction Report',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            'status' => $data['status'],
            'results' => DetailReportModel::getNotes( 
                $data['startDate'], 
                $data['endDate'],
                $data['status']),
            'export' => json_encode(DetailReportModel::getExportNotes(
                $data['startDate'], 
                $data['endDate'],
                $data['status'])),
        ]);
    }

    public function comulationSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/external/comulative.report', [
            'title' => 'Comulative Report',
            'errors' => Session::get('errors'),
            'pageName' => 'Comulative Settlement Report',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            'status' => $data['status'],
            'results' => SummaryReportModel::getSettlementByDate(
                $data['startDate'], 
                $data['endDate'],
                $data['status']),
            'export' => json_encode(SummaryReportModel::getExportSettlementByDate(
                $data['startDate'], 
                $data['endDate'],
                $data['status']))
        ]);
    }

    public function callCenter() 
    {
        return Render::view('biReports/internal/call.center', [
            'title' => 'Call Center Report',
            'errors' => Session::get('errors'),
            'pageName' => ' Call Center Reps Report',
        ]);
    }

    public function agentOps() 
    {
        return Render::view('biReports/internal/agent.ops', [
            'title' => 'Agent Operations Report',
            'errors' => Session::get('errors'),
            'pageName' => ' Agent/ADR logs',
        ]);
    }

    public function callCenterSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            // 'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/internal/call.center', [
            'title' => 'Call Center Reps Reports',
            'errors' => Session::get('errors'),
            'pageName' => 'CCR Reports',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            // 'status' => $data['status'],
            'results' => DetailReportModel::getCallLogs(
                $data['startDate'], 
                $data['endDate']),
                // $data['status']),
            'export' => json_encode(DetailReportModel::getExportCallLogs(
                $data['startDate'], 
                $data['endDate'])),
                // $data['status'])),
        ]);
    }

    public function agentOpsSearch()
    { 
        // dnd($_POST); 
        $instance = Validation::validate($data = [
            'startDate' => sanitize($_POST['startDate']),
            'endDate' => sanitize($_POST['endDate']),
            // 'status' => sanitize($_POST['status']),
        ],[
            'endDate' => 'required',
        ]);

        if ($data['startDate'] == NULL) {
            $data['startDate'] = $data['endDate'];
        }

        if (DateTimeDiff::isDateCompared($data['startDate'], $data['endDate'])) {
            $instance->error(
                'endDate', 'choose latest date'
            )->throw();
        }

        return Render::view('biReports/internal/agent.ops', [
            'title' => 'Agent/ADR issues Reports',
            'errors' => Session::get('errors'),
            'pageName' => 'Agent/ADR Reports',
            'start' => $data['startDate'],
            'end' => $data['endDate'],
            // 'status' => $data['status'],
            'results' => DetailReportModel::getAgentLogs(
                $data['startDate'], 
                $data['endDate']),
                // $data['status']),
            'export' => json_encode(DetailReportModel::getExportAgentLogs(
                $data['startDate'], 
                $data['endDate'])),
                // $data['status'])),
        ]);
    }
}