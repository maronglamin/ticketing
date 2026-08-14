<?php

namespace http\model\BiReports;

use core\Authenticator;

class SummaryReportModel
{
    public static function getKPIs()
    {
        return Authenticator::get()
            ->query("SELECT 
                    current_month.Transaction_type,
                    current_month.TotalAmount,
                    current_month.TotalCount as TotalCount,
                    current_month.TotalCount - IFNULL(prev_month.TotalCount, 0) AS CountDifference
                FROM
                    (SELECT
                        Transaction_type,
                        SUM(Transaction_amount) AS TotalAmount,
                        COUNT(Transaction_amount) AS TotalCount
                    FROM
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted 
                        AND created_at <= (SELECT MAX(created_at) FROM apsw_transaction_funding WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) AND MONTH(created_at) = MONTH(CURRENT_DATE()))
                        AND YEAR(created_at) = YEAR(CURRENT_DATE())
                        AND MONTH(created_at) = MONTH(CURRENT_DATE())
                        AND transaction_status = :transaction_status
                    GROUP BY
                        Transaction_type) AS current_month
                LEFT JOIN
                    (SELECT
                        Transaction_type,
                        COUNT(Transaction_amount) AS TotalCount
                    FROM
                        apsw_transaction_funding
                    WHERE 
                        soft_deleted = :soft_deleted 
                        AND created_at >= (
                            SELECT COALESCE(
                                MIN(created_at),
                                DATE_SUB(DATE_FORMAT(CURRENT_DATE(), '%Y-%m-01'), INTERVAL 1 MONTH)
                            )
                            FROM apsw_transaction_funding
                            WHERE YEAR(created_at) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
                            AND MONTH(created_at) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
                        )
                        AND YEAR(created_at) = YEAR(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
                        AND MONTH(created_at) = MONTH(DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH))
                        AND transaction_status = :transaction_status
                    GROUP BY
                        Transaction_type) AS prev_month
                ON current_month.Transaction_type = prev_month.Transaction_type", [
                            'soft_deleted' => 'NTDEL',
                            'transaction_status' => 'APPROVED'    
            ])->get();
    }

    public static function getSettlementKPIs()
    {
        return Authenticator::get()
        ->query("SELECT
                    Transaction_type,
                    SUM(debit_amount) AS TotalAmount,
                    COUNT(debit_amount) AS TotalCount
                FROM
                    aps_bank_note_trxn
                WHERE 
                    soft_deleted = :soft_deleted
                AND transaction_status = :transaction_status
                AND MONTH(created_at) = MONTH(CURRENT_DATE()) 
                AND YEAR(created_at) = YEAR(CURRENT_DATE())
                GROUP BY
                    Transaction_type", [
                'transaction_status' => 'CLOSED',
                'soft_deleted' => 'NTDEL'
            ])->find();
    }

    public static function getSettlementByCount()
    {
        return Authenticator::get()
            ->query("SELECT DISTINCT
                        agent_wallet_number,
                        agent_name,
                        SUM(debit_amount) AS total_debit_amount,
                        COUNT(*) AS transaction_count,
                        AVG(debit_amount) AS average_debit_amount
                    FROM
                        aps_bank_note_trxn
                    WHERE
                        soft_deleted = :soft_deleted
                    AND
                        MONTH(created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(created_at) = YEAR(CURRENT_DATE())
                    AND transaction_status = :transaction_status
                    GROUP BY
                        agent_name,
                        agent_wallet_number
                    ORDER BY
                        transaction_count
                    DESC
                    LIMIT 7",[
                        'soft_deleted' => 'NTDEL',
                        'transaction_status' => 'CLOSED',
                    ])->get();
    }

    public static function getSettlementByDate($start_time, $end_time, $status)
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT DISTINCT
                        agent_wallet_number,
                        agent_name,
                        SUM(debit_amount) AS total_debit_amount,
                        COUNT(*) AS transaction_count,
                        AVG(debit_amount) AS average_debit_amount
                    FROM
                        aps_bank_note_trxn
                    WHERE
                        soft_deleted = :soft_deleted
                    AND transaction_status = :transaction_status
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    GROUP BY
                        agent_name,
                        agent_wallet_number
                    ORDER BY 
                        transaction_count
                    DESC
                    LIMIT 15", [
                        'soft_deleted' => 'NTDEL',
                        'transaction_status' => $status
                    ])->get();
    }

    public static function getExportSettlementByDate($start_time, $end_time, $status)
    {
        // $start_time .= ' 00:00:00';
        // $end_time .= ' 23:59:59';

        return Authenticator::get()
            ->query("SELECT DISTINCT
                        agent_wallet_number,
                        agent_name,
                        SUM(debit_amount) AS total_debit_amount,
                        COUNT(*) AS transaction_count,
                        AVG(debit_amount) AS average_debit_amount
                    FROM
                        aps_bank_note_trxn
                    WHERE
                        soft_deleted = :soft_deleted
                    AND transaction_status = :transaction_status
                    AND created_at BETWEEN '{$start_time}' AND '{$end_time}'
                    GROUP BY
                        agent_name,
                        agent_wallet_number
                    ORDER BY 
                        transaction_count
                    DESC", [
                        'soft_deleted' => 'NTDEL',
                        'transaction_status' => $status
                    ])->get();
    }

}