<?php

namespace http\controller\Emails;

use core\Session;
use http\model\EmailModel;

class EmailNotificationController {

    public function queued() {
        return view('email.queued',  [
            'title' => 'Email Notification', 
            'bannerHeader' => 'Queued Emails',
            'tagline' => "Emails to be sent",
            'errors' => Session::get('errors'),
            'message' => 'Email notification sent successfully',
            'queued' => EmailModel::getQueuedEmails()
        ]);

    }
}
