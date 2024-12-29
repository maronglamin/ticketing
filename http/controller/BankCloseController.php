<?php

namespace http\controller;

use core\Session;
use core\Paginator;
use http\controller\Controller;
use http\model\OperationFormsModel;

class BankCloseController extends Controller
{
    public function index()
    {
        $folderData = [];
        foreach (OperationFormsModel::getSignedDocument(Paginator::start()) as $row) {
            $folder = $row['folder_name'];
            if (!isset($folderData[$folder])) {
                $folderData[$folder] = [];
            }
            $folderData[$folder][] = [
                'transaction_filename' => $row['transaction_filename'],
                'transaction_type' => $row['transaction_type'],
                'created_at' => $row['created_at'],
                'transaction_status' => $row['transaction_status'],
                'folder_id' => $row['folder_id'],
                'file_count' => $row['file_count'],
                'debit_note_form_id' => $row['debit_note_form_id']
            ];
        }

        return view('bankNote/sign/bankFile.view', [
            'title' => 'APSW operations',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Bank Note History',
            'tagline' => "Organize your Instruction files by Months",
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_bank_note_trxn'),
            'pages' => Paginator::pages('aps_bank_note_trxn'),
            'transactions' => OperationFormsModel::getRecentKillTransactions(),
            'monthBalance' => OperationFormsModel::getMonthKillBalance(),
            'folderData' => $folderData,
        ]);
    }
}