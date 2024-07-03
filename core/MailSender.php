<?php

namespace core;

use core\Session;
use core\phpmailer\src\SMTP;
use core\phpmailer\src\PHPMailer;


class MailSender 
{
    public static function sendEmail($to, $subject, $body)
    {

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = '';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '';                     //SMTP username
            $mail->Password   = '';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('request@apswallet.gm', 'APSW IT HELPDESK');
            $mail->addAddress($to);     //Add a recipient
            //$mail->addAddress($copiedUser);               //Name is optional
            $mail->addReplyTo('request@apswallet.gm', 'APSW TICKETING');
            // $mail->addCC($copiedUser);
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            Session::put('success', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
            
        }
    }


}
