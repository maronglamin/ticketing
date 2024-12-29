<?php

namespace http\controller\BankInstruction;

use core\Session;
use core\Response;
use core\Authenticator;
use http\forms\Validation;
use http\model\BankListModel;
use http\controller\Controller;

class BankListController extends Controller
{
    public function index()
    {
        return view('bankNote/bank.detail.view', [
            'title' => 'Bank Listing',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Partners In Banking',
            'tagline' => "Bank List for APS Settlements",
            'bankList' => BankListModel::getBankList(),
        ]);
    }

    public function store()
    {
        // dnd($_POST);
        $instance = Validation::validate($data = [
            'bank_name' => sanitize($_POST['bank_name']),
            'bank_acc_num' => sanitize($_POST['bank_acc_num']), 
            'acc_name' => sanitize($_POST['acc_name']),       
            'created_at' => cur_time(),
            'maker_id' => Session::user(),            
        ],
        [
            'bank_name' => 'required',
            'bank_acc_num' => 'required',
            'acc_name' => 'required',
        ]);
        
        Authenticator::save('instructed_banks', $data); 
                
        Session::flash('success', 'Bank details Saved');
        return redirect('/settlement/bank/list');
    }

    public function delete()
    {
        // dnd($_POST);
        Authenticator::commit('instructed_banks', sanitize($_POST['id']), [
            'soft_deleted' => Response::SOFT_DELETED,
            'updated_at' => cur_time(),
            'deleted_by' => Session::user(),
        ]); 

        return redirect('/settlement/bank/list');
    }
}