<?php

namespace http\model;


use core\Authenticator;
use core\Response;
use http\model\Model;

class EmailModel {

    public static function getQueuedEmails() {
        return Model::get()
        ->query("SELECT * FROM queue_email WHERE email_sent = :email_sent", [
            'email_sent' => Response::UNSENT_EMAIL
        ])->get();

    }

    public static function markEmailAsSent($emailId) {
        return Authenticator::commit('queue_email', $emailId, [
            'email_sent' => Response::SENT_EMAIL
        ]);

    }

    public static function logEmail($recipient, $subject, $mail_body, $status, $errorMessage = null) {
        return Authenticator::save('email_log', [
            'recipient' => $recipient,
            'subject' => $subject,
            'mail_body' => $mail_body,
            'status' => $status,
            'error_message' => $errorMessage
        ]);

    }
}
