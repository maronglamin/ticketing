<?php

namespace http\controller;

use core\Session;
use core\Response;

use core\Paginator;
use core\UploadImg;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\model\BankListModel;
use http\model\TicketingModel;
use http\controller\Controller;
use http\model\OperationFormsModel;

class BankNoteController extends Controller
{
    public function instruction()
    {
        $folderData = [];
        foreach (OperationFormsModel::getKillFolders(Paginator::start()) as $row) {
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

        return view('bankNote/index.view', [
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

    public function viewInstrustions()
    {
        // dnd($_GET);
        return view('bankNote/view.details.view', [
            'title' => 'Note Details',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Bank Note Details',
            'tagline' => "View the Bank Debit Note details",
            'transactions' => OperationFormsModel::getBankNotes(sanitize($_GET['view']))
        ]);
    }

    public function printInstrustions()
    {
        // dnd($_GET);
        return view('bankNote/details.view', [
            'title' => 'Note Details',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Bank Note Details',
            'tagline' => "View the Bank Debit Note details",
            'transactions' => OperationFormsModel::getBankNotes(sanitize($_GET['print']))
        ]);
    }

    public function new()
    {

        return view('bankNote/bankNote.form.view', [
            'title' => 'APSW Bank Note',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'New Note History',
            'tagline' => "Instruct a financial body for withdrawal",
            'transactions' => OperationFormsModel::getRecentKillTransactions(),
            'monthBalance' => OperationFormsModel::getMonthKillBalance(),
            'ticketing_id' => ModelData::getLastID('aps_bank_note_trxn'),
            'killAmount' => OperationFormsModel::getBankNotes(sanitize($_GET['view'])),
            'bankList' => BankListModel::getBankList()


        ]);
    }

    public function store()
    {
        // dnd($_POST);
        $instance = Validation::validate($data = [
            'debit_note_form_id' => sanitize($_POST['transaction_id']),
            'transaction_filename' => sanitize($_POST['transaction_filename']), 
            'Transaction_type' => sanitize($_POST['Transaction_type']),       
            'transaction_reason' => sanitize($_POST['transaction_reason']),
            'wallet_name' => sanitize($_POST['wallet_name']),
            'wallet_number' => sanitize($_POST['wallet_number']),
            'debit_instruction' => sanitize($_POST['debit_instruction']),
            'Agent_bank_nane' => sanitize($_POST['Agent_bank_nane']),
            'agent_bank_acc_num' => sanitize($_POST['agent_bank_acc_num']),
            'agent_paid_bank_name' => sanitize($_POST['agent_paid_bank_name']),
            'agent_paid_bank_acc_num' => sanitize($_POST['agent_paid_bank_acc_num']),
            'Agent_paid_acc_name' => sanitize($_POST['Agent_paid_acc_name']),
            'created_at' => cur_time(),
            'maker_id' => Session::user(),
            'transaction_status' => 'NOTE_CREATED'
            
        ],
        [

            'transaction_reason' => 'required',
            'agent_bank_acc_num' => 'required',
            'Agent_paid_acc_name' => 'required',
            'agent_paid_bank_acc_num' => 'required',
            'agent_paid_bank_name' => 'required',
            'debit_instruction' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveFile($instance);

        if (TicketingModel::getRefId($data['debit_note_form_id'])) {

            $instance->error(
                'Transaction_amount', 'The form Reference_id for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        
        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data); 
                
        Session::flash('success', 'Request sent successfully, seek for <strong>Bank Debit Note</strong> review');
        return redirect('/instrustions/bank/note');
    }

    public function editInstrustions() 
    {
        return view('bankNote/edit.form.view', [
            'title' => 'APSW Bank Note',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Edit Note History',
            'tagline' => "Edit Bank Note Instruction",
            'transactions' => OperationFormsModel::getRecentKillTransactions(),
            'editTrxns' =>OperationFormsModel::getBankKillMoney(sanitize($_GET['edit'])),
            'monthBalance' => OperationFormsModel::getMonthKillBalance(),
            'bankList' => BankListModel::getBankList()
        ]);
    }

    public function update()
    {
        Validation::validate($data = [
            'transaction_reason' => sanitize($_POST['transaction_reason']),
            'wallet_name' => sanitize($_POST['wallet_name']),
            'wallet_number' => sanitize($_POST['wallet_number']),
            'debit_instruction' => sanitize($_POST['debit_instruction']),
            'Agent_bank_nane' => sanitize($_POST['Agent_bank_nane']),
            'agent_bank_acc_num' => sanitize($_POST['agent_bank_acc_num']),
            'agent_paid_bank_name' => sanitize($_POST['agent_paid_bank_name']),
            'agent_paid_bank_acc_num' => sanitize($_POST['agent_paid_bank_acc_num']),
            'Agent_paid_acc_name' => sanitize($_POST['Agent_paid_acc_name']),
            'maker_id' => Session::user(),
            'transaction_status' => 'NOTE_CREATED'
            
        ],
        [
            'transaction_reason' => 'required',
            'agent_bank_acc_num' => 'required',
            'Agent_paid_acc_name' => 'required',
            'agent_paid_bank_acc_num' => 'required',
            'agent_paid_bank_name' => 'required',
            'debit_instruction' => 'required',        ]);
        
        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data); 
                
        Session::flash('success', 'Request sent successfully, seek for <strong>Bank Debit Note</strong> review');
        return redirect('/instrustions/bank/note');
    }

    public function review()
    {
        Validation::validate($data = [
            'transaction_status' => Response::REVIEW,
            'reviewed_by' => Session::user(), 
            'reviewed_at' => cur_time(),
            'reviewed_comment' => sanitize($_POST['comment'])
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Details Reviewed and saved successfully');
        return redirect('/instrustions/bank/note');
    }

    public function reject()
    {
        Validation::validate($data = [
            'transaction_status' => Response::REJECT,
            'reviewed_by' => Session::user(), 
            'rejected_at' => cur_time(),
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Details Reviewed and saved successfully');
        return redirect('/instrustions/bank/note');
    }

    public function approve()
    {
        Validation::validate($data = [
            'transaction_status' => Response::SENT_FOR_SIGNATURE,
            'approved_by' => Session::user(), 
            'approved_at' => cur_time(),
            'approved_comment' => sanitize($_POST['approved_comment']),
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Details Approved and Sent for Account Signatories');
        return redirect('/instrustions/bank/note');
    }

    public function player()
    {
        Validation::validate($data = [
            'transaction_status' => Response::STATUS_CLOSED,
            'closed_by' => Session::user(), 
            'closed_at' => cur_time(),
            'bank_officer_comment' => sanitize($_POST['bank_comment']),
            'officer_comment_at' => cur_time(),
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Bank Note closed successfully');
        return redirect('/user/bank/note');
    }

    public function RevSign()
    {
        Validation::validate($data = [
            'sign_1' => Session::user(), 
            'sign_at_1' => cur_time(),
            'sign_1_comment' => sanitize($_POST['sign_1_comment']),
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Signature Applied, awaiting second signature');
        return redirect('/signatures/bank/note');
    }

    public function ApproveSign()
    {
        Validation::validate($data = [
            'sign_2' => Session::user(), 
            'sign_at_2' => cur_time(),
            'sign_2_comment' => sanitize($_POST['sign_2_comment']),
            'transaction_status' => 'Signed & Approved'
        ],[]);

        Authenticator::commit('aps_bank_note_trxn', sanitize($_POST['id']), $data);  


        Session::flash('success', 'Signature Applied, Document Completed');
        return redirect('/signatures/bank/note');
    }



}