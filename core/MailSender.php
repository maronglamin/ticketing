<?php

namespace core;

use core\Router;
use core\Session;
use core\phpmailer\src\SMTP;
use core\phpmailer\src\Exception;
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
            $mail->Host       = 'smtp.gmail.com';                          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
            $mail->Username   = 'mlmarong14036@gmail.com';                  //SMTP username
            $mail->Password   = 'lrjd ukyb yvfj dral';                          //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          //Use STARTTLS (for compatibility)
            $mail->Port       = 587;  
            
            $mail->SMTPDebug = 2; // Set to 2 for detailed output
            $mail->Debugoutput = 'html';//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('request@apswallet.gm', 'APSW IMS Ticketing');
            $mail->addAddress($to);     //Add a recipient
            $mail->addAddress('modoulamin.marong@apswallet.gm');         //Name is optional
            $mail->addReplyTo('request@apswallet.gm', 'APS Wallet HelpDesk');
            $mail->addCC('sulayman.saidy@apswallet.gm');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            // $mail->Body    = file_get_contents(base_path($body_file_path));
            $mail->Body    = $body;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            Session::flash(
                    'success', 
                    "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            flush();
            return redirected(
                (new Router)->previousUrl()
            );
            
        }
    }


}