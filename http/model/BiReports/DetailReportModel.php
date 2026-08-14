<?php

namespace http\model\BiReports;

use core\Authenticator;

class DetailReportModel

{
    public static function getCreateMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        created_at,
                        bank_name,
                        bank_trxn_ref,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at,
                        transaction_filename
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC LIMIT 15", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Create_Money',
                ])->get();
    }

    public static function getExportCreateMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        created_at,
                        bank_name,
                        bank_trxn_ref,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Create_Money',
                ])->get();
    }

    public static function getAddMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        created_at,
                        wallet_name,
                        wallet_number,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC LIMIT 15", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Add_Money',
                ])->get();
    }

    public static function getExportAddMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        created_at,
                        wallet_name,
                        wallet_number,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Add_Money',
                ])->get();
    }

    public static function getKillMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        created_at,
                        agent_name,
                        agent_acc_number,
                        kill_money_trxnid,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC LIMIT 15", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Kill_Money',
                ])->get();
    }

    public static function getExportKillMoney($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        transaction_id,
                        Transaction_amount,
                        agent_name,
                        agent_acc_number,
                        kill_money_trxnid,
                        created_at,
                        wallet_name,
                        wallet_number,
                        Transaction_type,
                        transaction_status,
                        transaction_filename,
                        review_by,
                        Approved_by,
                        reviewed_at,
                        approved_at
                    FROM 
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND
                        Transaction_type = :Transaction_type
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'   
                    ORDER BY 
                        created_at DESC", [
                            'soft_deleted' => 'NTDEL',
                            'Transaction_type' => 'Kill_Money',
                ])->get();
    }

    public static function getNotes($start_time, $end_time, $status )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT
                        debit_note_form_id AS 'Form_id',
                        kill_money_form_id AS 'KillMoney_FormId',
                        Kill_money_trxn_id AS WithdrawTo_TrustTxnId,
                        debit_amount AS 'Transaction_amount',
                        created_at,
                        agent_name,
                        agent_bank_acc_name,
                        agent_bank_acc_num,
                        transaction_filename,
                        transaction_status,
                        sign_1,
                        sign_at_1,
                        sign_2,
                        sign_at_2,
                        closed_at,
                        closed_by
                    FROM
                        aps_bank_note_trxn
                    WHERE
                        prepare_note = :prepare_note
                    AND soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'
                    ORDER BY 
                        created_at DESC LIMIT 15", [
                        'soft_deleted' => 'NTDEL',
                        'prepare_note' => 'YES',
                ])->get();
    }

    public static function getExportNotes($start_time, $end_time, $status)
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT
                        debit_note_form_id AS 'Form_id',
                        kill_money_form_id AS 'KillMoney_FormId',
                        Kill_money_trxn_id AS WithdrawTo_TrustTxnId,
                        debit_amount AS 'Transaction_amount',
                        created_at,
                        agent_name,
                        agent_bank_acc_name,
                        agent_bank_acc_num,
                        transaction_filename,
                        transaction_status,
                        sign_1 AS 'APSW Acc_Sig_1',
                        sign_at_1,
                        sign_2 AS 'APSW Acc_Sig_1',
                        sign_at_2,
                        closed_by,
                        closed_at
                    FROM
                        aps_bank_note_trxn
                    WHERE
                        prepare_note = :prepare_note
                    AND soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    AND transaction_status = '{$status}'
                    ORDER BY 
                        created_at DESC", [
                        'soft_deleted' => 'NTDEL',
                        'prepare_note' => 'YES',
                ])->get();
    }

    public static function getCallLogs($start_time, $end_time )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        ticketId,
                        reasonForCall,
                        transactionType,
                        created_at,
                        customerName,
                        phoneNumber,
                        description,
                        maker_id  
                    FROM 
                        aps_call_center
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    ORDER BY 
                        created_at DESC LIMIT 50", [
                            'soft_deleted' => 'NTDEL'
                ])->get();
    }

    public static function getAgentLogs($start_time, $end_time )
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT *
                    FROM 
                        agent_ops
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    ORDER BY 
                        created_at DESC LIMIT 50", [
                            'soft_deleted' => 'NTDEL'
                ])->get();
    }

    public static function getExportCallLogs($start_time, $end_time)
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT 
                        ticketId,
                        transactionType,
                        reasonForCall,
                        created_at,
                        customerName,
                        phoneNumber,
                        maker_id,
                        description  
                    FROM 
                        aps_call_center
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    ORDER BY 
                        created_at DESC", [
                            'soft_deleted' => 'NTDEL'
                ])->get();
    }

    public static function getExportAgentLogs($start_time, $end_time)
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT *  
                    FROM 
                        agent_ops
                    WHERE 
                        soft_deleted = :soft_deleted
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    ORDER BY 
                        created_at DESC", [
                            'soft_deleted' => 'NTDEL'
                ])->get();
    }
}