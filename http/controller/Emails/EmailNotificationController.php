<?php

namespace http\controller\Emails;

use core\Session;
use http\model\EmailModel;

class EmailNotificationController {

    public function queued() {
        return view('email/queued.view',  [
            'title' => 'Email Notification', 
            'heading' => 'Queued Emails',
            'errors' => Session::get('errors'),
            'message' => 'Email notification sent successfully',
            'queued' => EmailModel::getQueuedEmails()
        ]);

    }
}