<?php

namespace http\model;

use core\Response;
use core\Authenticator;

class OperationFormsModel 
{
    public static function getFolders($start)
    {
        return Authenticator::get()
                ->query("SELECT DATE_FORMAT(created_at, '%M %Y') AS folder_name,
                                id AS folder_id,
                                transaction_filename, 
                                transaction_type,
                                transaction_status,
                                created_at,
                                COUNT(*) AS file_count
                            FROM 
                                apsw_transaction_funding
                            GROUP BY 
                                folder_name, transaction_filename, folder_id
                            ORDER BY 
                                folder_name ASC,
                                created_at DESC limit $start," . Response::PAGE_RECORD
                    )->get();
    }

    public static function getKillFolders($start)
    {
        return Authenticator::get()
                ->query("SELECT DATE_FORMAT(created_at, '%M %Y') AS folder_name,
                                id AS folder_id,
                                transaction_filename, 
                                transaction_type,
                                transaction_status,
                                created_at,
                                debit_note_form_id,
                                COUNT(*) AS file_count
                            FROM 
                                aps_bank_note_trxn
                            WHERE 
                                transaction_type = 'Kill_Money'
                            GROUP BY 
                                folder_name, transaction_filename, folder_id
                            ORDER BY 
                                folder_name ASC,
                                created_at DESC limit $start," . Response::PAGE_RECORD
                    )->get();
    }

    public static function getBankFolders($start)
    {
        return Authenticator::get()
                ->query("SELECT DATE_FORMAT(created_at, '%M %Y') AS folder_name,
                                id AS folder_id,
                                transaction_filename, 
                                transaction_type,
                                transaction_status,
                                created_at,
                                debit_note_form_id,
                                COUNT(*) AS file_count
                            FROM 
                                aps_bank_note_trxn
                            WHERE 
                                transaction_type = 'Kill_Money'
                            AND transaction_status = 'PENDING_SIGNATURE' 
                            OR  transaction_status = 'CLOSED'
                            OR  transaction_status = 'Signed & Approved'
                            GROUP BY 
                                folder_name, transaction_filename, folder_id
                            ORDER BY 
                                folder_name ASC,
                                created_at DESC limit $start," . Response::PAGE_RECORD
                    )->get();
    }

    public static function getSignedDocument($start)
    {
        return Authenticator::get()
                ->query("SELECT DATE_FORMAT(created_at, '%M %Y') AS folder_name,
                                id AS folder_id,
                                transaction_filename, 
                                transaction_type,
                                transaction_status,
                                created_at,
                                debit_note_form_id,
                                COUNT(*) AS file_count
                            FROM 
                                aps_bank_note_trxn
                            WHERE 
                                transaction_type = 'Kill_Money'
                            AND transaction_status = 'Signed & Approved'
                            OR  transaction_status = 'PENDING_SIGNATURE'
                            OR  transaction_status = 'CLOSED'
                            GROUP BY 
                                folder_name, transaction_filename, folder_id
                            ORDER BY 
                                folder_name ASC,
                                created_at DESC limit $start," . Response::PAGE_RECORD
                    )->get();
    }

    public static function getRecentTransactions()
    {
        return Authenticator::get()
                ->query("SELECT 
                                transaction_amount,
                                transaction_status,
                                DATE_FORMAT(created_at, '%M %d') AS trxDate
                            FROM 
                                apsw_transaction_funding
                            WHERE 
                                soft_deleted = 'NTDEL'
                            ORDER BY 
                                created_at DESC
                            LIMIT 3"
                    )->get();
    }

    public static function getRecentKillTransactions()
    {
        return Authenticator::get()
                ->query("SELECT 
                                debit_amount,
                                wallet_number,
                                transaction_status,
                                wallet_name,
                                debit_instruction,
                                transaction_reason,
                                DATE_FORMAT(created_at, '%M %d') AS trxDate
                            FROM 
                                aps_bank_note_trxn
                            WHERE 
                                soft_deleted = 'NTDEL'
                            ORDER BY 
                                created_at DESC
                            LIMIT 3"
                    )->get();
    }

    public static function getMonthBalance()
    {
        return Authenticator::get()
                ->query("SELECT 
                                transaction_type, 
                                SUM(transaction_amount) AS total_amount
                            FROM 
                                apsw_transaction_funding
                            WHERE 
                                soft_deleted = 'NTDEL' 
                                AND MONTH(created_at) = MONTH(CURRENT_DATE()) 
                                AND YEAR(created_at) = YEAR(CURRENT_DATE())
                                AND transaction_status = 'APPROVED'
                            GROUP BY 
                                transaction_type"

                    )->get();
    }

    public static function getMonthKillBalance()
    {
        return Authenticator::get()
                ->query("SELECT 
                                transaction_type, 
                                SUM(debit_amount) AS total_amount
                            FROM 
                                aps_bank_note_trxn
                            WHERE 
                                soft_deleted = 'NTDEL' 
                                AND MONTH(created_at) = MONTH(CURRENT_DATE()) 
                                AND YEAR(created_at) = YEAR(CURRENT_DATE())
                                AND transaction_status = 'APPROVED'
                            GROUP BY 
                                transaction_type"

                    )->get();
    }

    public static function getTransactions($id)
    {
        return Authenticator::get()
                ->query("SELECT * FROM apsw_transaction_funding WHERe id = :id AND soft_deleted = :soft_deleted", [
                    'soft_deleted' => 'NTDEL',
                    'id' => $id
                ])->get();
    }

    public static function getBankNotes($id)
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_bank_note_trxn WHERe id = :id AND soft_deleted = :soft_deleted", [
                    'soft_deleted' => 'NTDEL',
                    'id' => $id
                ])->get();
    }

    public static function getBankKillMoney($id)
    {
        return Authenticator::get()
                ->query("SELECT * FROM aps_bank_note_trxn WHERe id = :id AND soft_deleted = :soft_deleted", [
                    'soft_deleted' => 'NTDEL',
                    'id' => $id
                ])->find();
    }
    
    
    
}