<?php

namespace http\controller;

use core\Session;
use core\Response;
use core\Paginator;
use core\UploadImg;
use core\Authenticator;
use http\model\ModelData;
use http\forms\Validation;
use http\model\TicketingModel;
use http\model\OperationFormsModel;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $folderData = [];
        foreach (OperationFormsModel::getFolders(Paginator::start()) as $row) {
            $folder = $row['folder_name'];
            $subfolder = $row['subfolder_name'];
            
            // Initialize folder if not set
            if (!isset($folderData[$folder])) {
                $folderData[$folder] = [];
            }
            
            // Initialize subfolder if not set
            if (!isset($folderData[$folder][$subfolder])) {
                $folderData[$folder][$subfolder] = [];
            }

            // Append the transaction to the subfolder
            $folderData[$folder][$subfolder][] = [
                'transaction_filename' => $row['transaction_filename'],
                'transaction_type' => $row['transaction_type'],
                'created_at' => $row['created_at'],
                'transaction_status' => $row['transaction_status'],
                'folder_id' => $row['folder_id'],
                'file_count' => $row['file_count'],
                'maker_id' => $row['maker_id']
            ];
        }
        
        return view('operations/index.view', [
            'title' => 'APSW operations',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Transaction History',
            'tagline' => "Organize your transactions by Months",
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('apsw_transaction_funding'),
            'pages' => Paginator::pages('apsw_transaction_funding'),
            'transactions' => OperationFormsModel::getRecentTransactions(),
            'monthBalance' => OperationFormsModel::getMonthBalance(),
            'folderData' => $folderData,
        ]);
    }

    public function transactionData()
    {
        return view('operations/details.view', [
            'title' => 'transaction Details',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Add Money Transaction',
            'tagline' => "Transaction Details and Suuporting Documents",
            'transactions' => OperationFormsModel::getTransactions(sanitize($_GET['print']))
        ]);
    }

    public function viewTransactionData()
    {
        return view('operations/viewDetails.view', [
            'title' => 'transaction Details',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'View Transaction Detail',
            'tagline' => "Transaction Details and attached Documents",
            'transactions' => OperationFormsModel::getTransactions(sanitize($_GET['view'])),
        ]);
    }

    public function editTransactionData()
    {
        return view('operations/edit.view', [
            'title' => 'Edit transaction Details',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Edit Transaction Detail',
            'tagline' => "Edit Transaction Details and attached Documents",
            'transactions' => OperationFormsModel::getTransactions(sanitize($_GET['edit'])),
        ]);
    }

    public function addMoney()
    {
        return view('operations/add.money.view', [
            'title' => 'transaction Details',
            'bannerHeader' => 'Add Money Transaction',
            'errors' => Session::get('errors'),
            'tagline' => "Add Transaction form and Upload Supporting Documents",
            'ticketing_id' => ModelData::getLastID('apsw_transaction_funding'),
            'transactions' => OperationFormsModel::getRecentTransactions(),
            'monthBalance' => OperationFormsModel::getMonthBalance(),

        ]);
    }
    public function createMoney()
    {
        return view('operations/create.money.view', [
            'title' => 'transaction Details',
            'bannerHeader' => 'Create Money Transaction',
            'errors' => Session::get('errors'),
            'tagline' => "Create Transaction form and Upload Supporting Documents",
            'ticketing_id' => ModelData::getLastID('apsw_transaction_funding'),
            'transactions' => OperationFormsModel::getRecentTransactions(),
            'monthBalance' => OperationFormsModel::getMonthBalance(),

        ]);
    }
    public function KillMoney()
    {
        return view('operations/kill.money.view', [
            'title' => 'transaction Details',
            'bannerHeader' => 'Kill Money Transaction',
            'errors' => Session::get('errors'),
            'tagline' => "Kill Transaction form and Upload Supporting Documents",
            'ticketing_id' => ModelData::getLastID('apsw_transaction_funding'),
            'transactions' => OperationFormsModel::getRecentTransactions(),
            'monthBalance' => OperationFormsModel::getMonthBalance(),

        ]);
    }
    public function review()
    {
        Validation::validate($data = [
            'transaction_status' => Response::REVIEW,
            'review_by' => Session::user(), 
            'reviewed_at' => cur_time(),
            'comment' => sanitize($_POST['comment'])
        ],[]);

        // if (sanitize($_POST['transaction_type']) === 'KILL_MONEY') {
        //     Authenticator::customCommit(
        //         'aps_bank_note_trxn',
        //         'kill_money_form_id',
        //         sanitize($_POST['transaction_id']),
        //         ['prepare_note' => 'YES']
        //     );  
        // }
        Authenticator::commit(
            'apsw_transaction_funding',
            sanitize($_POST['id']),
            $data
        );  

        Session::flash('success', 'Reviewed for filing');
        return redirect('/transaction/history');
    }

    public function reject()
    {
        Validation::validate($data = [
            'transaction_status' => Response::REJECT,
            'rejected_by' => Session::user(), 
            'reject_at' => cur_time(),
        ],[]);

        Authenticator::commit(
            'apsw_transaction_funding',
            sanitize($_POST['id']),
            $data
        );  


        Session::flash('success', 'Details Reviewed and REJECTED successfully');
        return redirect('/transaction/history');
    }

    public function approve()
    {
        Validation::validate($data = [
            'transaction_status' => Response::APPROVE,
            'Approved_by' => Session::user(), 
            'approved_at' => cur_time(),
            'approve_comment' => sanitize(
                $_POST['approve_comment']
            ),
        ],[]);

        if (sanitize($_POST['transaction_type']) === 'KILL_MONEY') {
            Authenticator::customCommit(
                'aps_bank_note_trxn',
                'kill_money_form_id',
                sanitize($_POST['transaction_id']),
                ['prepare_note' => 'YES']
            );  
        }

        Authenticator::commit(
            'apsw_transaction_funding',
            sanitize($_POST['id']),
            $data
        );  

        Session::flash('success', 'Details Approved and saved successfully');
        return redirect('/transaction/history');
    }

    public function storeAddMoney() 
    {
        // dnd($_POST);
        $instance = Validation::validate($data = [
            'transaction_id' => sanitize(trim($_POST['transaction_id'])),
            'transaction_filename' => "Add_Money - ". sanitize(trim($_POST['wallet_name'])) . ' - ' . sanitize(trim($_POST['wallet_number'])) . ' - '. slashDate() , 
            'Transaction_type' => sanitize(trim($_POST['Transaction_type'])),       
            'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
            'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
            'wallet_name' => sanitize(trim($_POST['wallet_name'])),
            'wallet_number' => sanitize(trim($_POST['wallet_number'])),
            'cm_serial' => sanitize(trim($_POST['cm_serial'])),
            'created_at' => cur_time(),
            'maker_id' => Session::user(),
            
        ],
        [
            'wallet_number' => 'required',
            'wallet_name' => 'required',
            'transaction_reason' => 'required',
            'Transaction_amount' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveFile($data['transaction_id'], $instance);

        if (TicketingModel::getRefId($data['transaction_id'])) {

            $instance->error(
                'Transaction_amount', 'The form Reference_id for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        
        Authenticator::save('apsw_transaction_funding', $data); 
                
        Session::flash('success', 'Request sent successfully, seek for <strong>Add_Money</strong> review');
        return redirect('/transaction/history');
        

    }


    public function storeCreateMoney() 
    {
        $instance = Validation::validate($data = [
            'transaction_id' => sanitize(trim($_POST['transaction_id'])),
            'transaction_filename' => "Create_Money - " . sanitize(trim($_POST['bank_name'])) .' - '. slashDate(), 
            'Transaction_type' => sanitize(trim($_POST['Transaction_type'])),       
            'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
            'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
            'bank_trxn_ref' => sanitize(trim($_POST['bank_trxn_ref'])),
            'bank_name' => sanitize(trim($_POST['bank_name'])),
            'bank_trxn_narration' => sanitize(trim($_POST['bank_trxn_narration'])),
            'created_at' => cur_time(),
            'maker_id' => Session::user(),
            
        ],
        [
            'bank_trxn_ref' => 'required',
            'transaction_reason' => 'required',
            'Transaction_amount' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveFile($data['transaction_id'], $instance);

        if (TicketingModel::getRefId($data['transaction_id'])) {

            $instance->error(
                'Transaction_amount', 'The form Reference_id for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        
        Authenticator::save('apsw_transaction_funding', $data); 
                
        Session::flash('success', "Request sent successfully, seek for <strong> Create_Money Approval </strong>");
        return redirect('/transaction/history');
        

    }
    public function storeKillMoney() 
    {
        $instance = Validation::validate($data = [
            'transaction_id' => sanitize(trim($_POST['transaction_id'])),
            'transaction_filename' => "Kill_Money - ". sanitize(trim($_POST['agent_name'])) . ' - '. slashDate(), 
            'Transaction_type' => sanitize(trim($_POST['Transaction_type'])),       
            'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
            'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
            'agent_name' => sanitize(trim($_POST['agent_name'])),
            'agent_acc_number' => sanitize(trim($_POST['agent_acc_number'])),
            'kill_money_trxnid' => sanitize(trim($_POST['kill_money_trxnid'])),
            'created_at' => cur_time(),
            'maker_id' => Session::user(),
            'transaction_status' => Response::APPROVE,
            'Approved_by' => 'SYSTEM AUTO AUTH', 
            'approved_at' => cur_time(),
            'approve_comment' => 'AUTO AUTHORIZED',
            
        ],
        [
            'agent_acc_number' => 'required',
            'kill_money_trxnid' => 'required',
            'agent_name' => 'required',
            'transaction_reason' => 'required',
            'Transaction_amount' => 'required',
        ]);

        $data['upload_file'] = UploadImg::saveFile($data['transaction_id'], $instance);

        if (TicketingModel::getRefId($data['transaction_id'])) {

            $instance->error(
                'Transaction_amount', 'The form Reference_id for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        
        Authenticator::save('apsw_transaction_funding', $data); 

        Authenticator::save(
            'aps_bank_note_trxn', [
                'kill_money_form_id' => $data['transaction_id'],
                'transaction_filename' => $data['transaction_filename'], 
                'Transaction_type' => $data['Transaction_type'],       
                'Kill_money_trxn_id' => $data['kill_money_trxnid'],
                'debit_amount' => $data['Transaction_amount'],
                'agent_name' => $data['agent_name'],
                'agent_wallet_number' => $data['agent_acc_number'],
                'created_at' => cur_time(),
                'maker_id' => Session::user(),
                'upload_file' => $data['upload_file'],
                'prepare_note' => 'YES',
        ]); 
                
        Session::flash('success', "Request sent successfully, seek for <strong> Kill_Money review </strong>");
        return redirect('/transaction/history');
        
    }

    public function storeEditedTransaction() 
    {
        // dnd($_POST);
        if (trim(sanitize($_POST['Transaction_type'])) == 'Create_Money')
        {
            // validate the Create money edit request

            $instance = Validation::validate($data = [
                'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
                'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
                'bank_trxn_ref' => sanitize(trim($_POST['bank_trxn_ref'])),
                'bank_name' => sanitize(trim($_POST['bank_name'])),
                'bank_trxn_narration' => sanitize(trim($_POST['bank_trxn_narration'])),
                'created_at' => cur_time(),
                'maker_id' => Session::user(),
                'review_by' => NULL,
                'transaction_status' => 'PENDING'
                
            ],
            [
                'bank_trxn_ref' => 'required',
                'transaction_reason' => 'required',
                'Transaction_amount' => 'required',
            ]);

        } elseif (trim(sanitize($_POST['Transaction_type'])) === 'Add_Money')
        {
            // validate the add money edit request

            $instance = Validation::validate($data = [
                'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
                'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
                'wallet_name' => sanitize(trim($_POST['wallet_name'])),
                'wallet_number' => sanitize(trim($_POST['wallet_number'])),
                'cm_serial' => sanitize(trim($_POST['cm_serial'])),
                'created_at' => cur_time(),
                'maker_id' => Session::user(),
                'review_by' => NULL,
                'transaction_status' => 'PENDING'
                
            ],
            [
                'wallet_number' => 'required',
                'wallet_name' => 'required',
                'transaction_reason' => 'required',
                'Transaction_amount' => 'required',
            ]);
        } else {
            // otherwise use the kill money edit reques.

            $instance = Validation::validate($data = [
                'Transaction_amount' => sanitize(trim($_POST['Transaction_amount'])),
                'transaction_reason' => sanitize(trim($_POST['transaction_reason'])),
                'agent_name' => sanitize(trim($_POST['agent_name'])),
                'agent_acc_number' => sanitize(trim($_POST['agent_acc_number'])),
                'kill_money_trxnid' => sanitize(trim($_POST['kill_money_trxnid'])),
                'created_at' => cur_time(),
                'maker_id' => Session::user(),
                'review_by' => NULL,
                'transaction_status' => 'PENDING'

                
            ],
            [
                'agent_acc_number' => 'required',
                'kill_money_trxnid' => 'required',
                'agent_name' => 'required',
                'transaction_reason' => 'required',
                'Transaction_amount' => 'required',
            ]);
        }
        
        Authenticator::commit('apsw_transaction_funding', sanitize($_POST['id']), $data); 
                
        Session::flash('success', "Form editd successfully, seek for <strong>Approval</strong>");
        return redirect('/transaction/history');
        
    }

}