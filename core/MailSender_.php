<?php

namespace core;

use SendGrid;
use SendGrid\Mail\Mail;

require base_path('vendor/autoload.php');

class MailSender 
{

    public static function sendEmail($to, $subject, $body)
    {
        // Your SendGrid API key
        $apiKey = 'fGQhUkO5nGU3gTmGHdRg6dhSNBROtKzM';
        $sg = new SendGrid($apiKey);

        $email = new Mail(); 
        $email->setFrom("from@example.com", "Example Sender");
        $email->setSubject($subject);
        $email->addTo($to, "Example Recipient");
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent("text/html", $body);

        try {
            $response = $sg->send($email);
            Session::flash('success', "Response Code: " . $response->statusCode() . "\n". "Response Body: " . $response->body() . "\n". "Response Headers: " . $response->headers() . "\n");
        } 
        catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }


    }
}