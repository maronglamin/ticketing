<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

$mail = new PHPMailer(true);

// Database connection
$conn = mysqli_connect("127.0.0.1", "root", "Apsw321", "mobifin_dataset");

$query = "SELECT * FROM queue_email WHERE email_sent = 0";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    try {

        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'apswallet.gm'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'request@apswallet.gm';
        $mail->Password = 'Allah@123';
        $mail->setFrom('request@apswallet.gm', 'APS eTicketing HELPDESK');

        $mail->addAddress($row['recipient']);
        $mail->Subject = $row['subject'];
        $mail->Body    = $row['mail_body'];


        $mail->addCC($row['copied_user']);

        if ($mail->send()) {
            $updateQuery = "UPDATE queue_email SET email_sent = 1 WHERE id = {$row['id']}";
            mysqli_query($conn, $updateQuery);
        }

    } catch (Exception $e) {
        $logQuery = "INSERT INTO email_log (`recipient`, `subject`, `status`, `error_message`, `created_at`, `mail_body`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $logQuery);
        mysqli_stmt_bind_param($stmt, $row['recipient'], $row['subject'], 'Fail', $mail->ErrorInfo, date("Y-m-d H:i:s"),  $row['mail_body']);
        return mysqli_stmt_execute($stmt);
    }
}

