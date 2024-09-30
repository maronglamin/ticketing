<?php
//require 'vendor/autoload.php'; // Ensure you include the PHPMailer autoloader
namespace http\controller;

use Exception;
use core\Response;
use core\phpmailer\src\SMTP;
use core\phpmailer\src\PHPMailer;

class EmailController {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP() {
        // Configure SMTP settings
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host = Response::EMAIL_HOST; // Your SMTP server
        $this->mail->SMTPAuth = true;
        $this->mail->Username = Response::EMAIL_USERNAME;
        $this->mail->Password = Response::EMAIL_PASSWORD;
        $this->mail->setFrom(Response::EMAIL_USERNAME, Response::EMAIL_FROM_USERNAME);
    }

    public  function error() {
        return $this->mail->ErrorInfo;
    }

    public function sendEmail($recipient, $subject, $message, $cc = null) {
        try {
            // Add primary recipient
            $this->mail->addAddress($recipient);

            // Add CC recipient if provided
            if ($cc) {
                $this->mail->addCC($cc);
            }

            // Set email subject and body
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;

            // Send email
            if ($this->mail->send()) {
                return true; // Email sent successfully
            } else {
                return false; // Email failed to send
            }
        } catch (Exception $e) {
            return false; // Return false on failure
        } finally {
            // Clear all addresses and attachments for next use
            $this->mail->clearAddresses();
            $this->mail->clearCCs();
        }
    }
}
