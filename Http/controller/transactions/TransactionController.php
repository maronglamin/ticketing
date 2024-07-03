<?php

namespace Http\controller\transactions;

use Http\controller\Controller;

class TransactionController extends Controller 
{
    public function journal()
    {
        return view('transaction/journal.view', [
            'title' => 'Transaction Journal',
            'headings' => 'Transaction Journals',
            'instruction' => 'Transaction Journal'
        ]);
    }
}