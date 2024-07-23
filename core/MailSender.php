<?php

namespace core;

use core\Router;
use core\Session;
use core\phpmailer\src\SMTP;
use core\phpmailer\src\PHPMailer;


class MailSender 
{
    public static function sendEmail($to, $subject, $body_file_path)
    {

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'apswallet.gm';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'request@apswallet.gm';                     //SMTP username
            $mail->Password   = 'Request@it.apsw';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('request@apswallet.gm', 'APSW IT HELPDESK');
            $mail->addAddress($to);     //Add a recipient
            $mail->addAddress('modoulamin.marong@apswallet.gm');               //Name is optional
            $mail->addReplyTo('request@apswallet.gm', 'APSW TICKETING');
            // $mail->addCC('modoulamin.marong@apswallet.gm');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = file_get_contents(base_path($body_file_path));
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            Session::put('success', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return redirected((new Router)->previousUrl());
            
        }
    }


}