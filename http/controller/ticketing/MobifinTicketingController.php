<?php

namespace http\controller\ticketing;

use core\Session;
use core\Response;
use core\Paginator;
use core\UploadImg;
use core\Authenticator;
use core\MailSender;
use http\model\ModelData;
use http\forms\Validation;
use http\model\TicketingModel;
use http\controller\Controller;
use http\model\mobifin\MPRmodel;
use http\model\mobifin\CategoryModel;

class MobifinTicketingController extends Controller
{
    public function new()
    {
        return view('ticketing/mobifin/new.mobifin.view', [
            'title' => 'New MPR',
            'errors' => Session::get('errors'),
            'heading' => 'New Request',
            'instruction' => 'Send a new request',
            'ticketing_id' => ModelData::getLastID('aps_ticketing'),
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('aps_ticketing'),
            'pages' => Paginator::pages('aps_ticketing'),
            'data' => MPRmodel::getMPR('aps_ticketing', Paginator::start()),
            'categories' => CategoryModel::findParent(),
            'subCategories' => CategoryModel::child(),
        ]);
    }

    public function category()
    {
        return view('ticketing.mobifin.categoriesMobifin', [
            'title' => 'Category',
            'errors' => Session::get('errors'),
            'bannerHeader' => 'Ticket Categories',
            'tagline' => "Organize the tickets by categories and sub-categories",
            'page' => Paginator::page(),
            'start' => Paginator::start(),
            'records' => Paginator::paginate('mpr_catergories'),
            'pages' => Paginator::pages('mpr_catergories'),
            'data' => CategoryModel::getParent('mpr_catergories'),
            'parent' => CategoryModel::findParent(),
        ]);
    }

    public function store()
    {
        Validation::validate($data = [
            'parent' => sanitize($_POST['parent']),
            'category' => sanitize($_POST['category']),
            'make_at' => cur_time(),
            'maker_id' => Session::user(),
        ],

        [
            'category' => 'required',
        ]);
            
        
        Authenticator::save('mpr_catergories', $data); 
            
        Session::flash('success', 'added successfully');
        return redirect('/mobifin/category/ticket');
        
    }

    public function destroySubCategory()
    {
        Authenticator::commit('mpr_catergories', sanitize($_POST['id']), [
            'maker_id' => Session::user(),
            'make_at' => cur_time(),
            'soft_deleted' => Response::SOFT_DELETED,
        ]); 

        Session::flash('success', 'Sub-category deleted');
        return redirect('/mobifin/category/ticket');

    }

    public function destroyCategory()
    {
        Authenticator::commit('mpr_catergories', sanitize($_POST['id']), [
            'maker_id' => Session::user(),
            'make_at' => cur_time(),
            'soft_deleted' => Response::SOFT_DELETED,
        ]);

        Authenticator::customCommit('mpr_catergories', 'parent', sanitize($_POST['id']), [
            'maker_id' => Session::user(),
            'make_at' => cur_time(),
            'soft_deleted' => Response::SOFT_DELETED,
        ]); 

        Session::flash('success', 'Category and children/child are deleted successfully');
        return redirect('/mobifin/category/ticket');

    }

    public function storeTicket()
    {
        $instance = Validation::validate($data = [
            'category' => sanitize($_POST['category']),
            'sub_category' => sanitize($_POST['sub_category']),
            'summary' => sanitize($_POST['summary']),
            'department' => sanitize($_POST['department']),
            'description' => sanitize($_POST['description']),
            'ticketId' => sanitize($_POST['ticketId']),
            'make_at' => cur_time(),
            'maker_id' => Session::user(),
            'host' => ($_POST['host']),
            'priority' => ($_POST['priority']),
            'email' => ($_POST['email']),
            'user_department' => Session::department()
        ],
        [
            'sub_category' => 'required',
            'category' => 'required',
            'summary' => 'required',
            'department' => 'required',
            'description' => 'required',
            'priority' => 'required'
        ]);

        $email_detail = [
            'ticket_id' => sanitize($_POST['ticketId']),
            'subject' => sanitize($_POST['ticketId']). ' '. sanitize($_POST['summary']),
            'mail_body' => sanitize($_POST['description']),
            'recipient' => ($_POST['email']),
            'copied_user' => Response::DEFUALT_COPIED_USER,
            'created_at' => cur_time(),
            'updated_at' => cur_time(),
            'remark' => 'Ticket raise  by user '.sanitize($_POST['email'])  .' on '.sanitize($_POST['summary']) . ' using  '.sanitize($_POST['host']) .' machine IP address',
        ];

       // $data['file_path'] = UploadImg::saveFile($instance);

        if (TicketingModel::getTicketId($data['ticketId'])) {

            $instance->error(
                'category', 'TICKET ID for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        

        Authenticator::save('aps_ticketing', $data); 

        Authenticator::save('queue_email', $email_detail); 
                
        Session::flash('success', 'Request sent successfully');
        return redirect('/dashboard');
        

    }

    public function storeRaiseTicket()
    {
        $rule = [
            'summary' => 'required',
            'department' => 'required',
            'priority' => 'required'
        ];


        $instance = Validation::validate($data = [
            'category' => sanitize($_POST['category']),
            'sub_category' => sanitize($_POST['sub_category']),
            'summary' => sanitize($_POST['summary']),
            'department' => sanitize($_POST['department']),
            'description' => sanitize($_POST['description']),
            'ticketId' => sanitize($_POST['ticketId']),
            'make_at' => cur_time(),
            'maker_id' => Session::user(),
            'host' => ($_POST['host']),
            'priority' => ($_POST['priority']),
            'email' => ($_POST['email']),
            'user_department' => Session::department()
        ], $rule);
        

        // $uri = 'https://aps-ticketing.apswallet.gm/ticketing/status/details?ticket='. $data['ticketId'];

        // $emailTemplate = $this->getEmailTemplate($data, $uri);

        if (TicketingModel::getTicketId($data['ticketId'])) {
            $instance->error(
                'ticketId', 'A ticket with the provided ID already exists. Please refresh and try again.'
            )->throw();
        }

        $data['upload_file'] = UploadImg::saveCommentFile($data['ticketId'], $instance);

        // $emailDetail = [
        //     'subject' => 'APS IMS Ticketing::' . $data['ticketId']. ' '. $data['summary'],
        //     'mail_body' => $emailTemplate,
        //     'recipient' => sanitize($_POST['dept_email']),
        //     'created_at' => cur_time(),
        // ];

        Authenticator::save('aps_ticketing', $data); 

        // MailSender::sendEmail(
        //     $emailDetail['recipient'], 
        //     $emailDetail['subject'], 
        //     $emailDetail['mail_body']
        // );
                
        Session::flash('success', 'Request sent successfully');
        return redirect('/dashboard');
    }

    private function getEmailTemplate($data, $uri)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Email Notification</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    background: #ffffff;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                .header {
                    background: #007bff;
                    color: white;
                    text-align: center;
                    padding: 15px;
                    font-size: 20px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                }
                .content {
                    padding: 20px;
                    font-size: 16px;
                    color: #333;
                    line-height: 1.5;
                }
                .button {
                    display: block;
                    width: 200px;
                    background: #007bff;
                    color: white;
                    text-align: center;
                    padding: 12px;
                    margin: 20px auto;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 5px;
                }
                .footer {
                    text-align: center;
                    font-size: 14px;
                    color: #888;
                    padding: 10px;
                }
                @media (max-width: 600px) {
                    .container {
                        width: 95%;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    IMS Ticketing Alert
                </div>
                <div class="content">
                    <p>Hello there. </p>
                    <p>The user '. fullname() . ' raised the below details through APS IMS Ticketing.</p>
                    <strong>Category: </strong> '. $data['category'] . '<br><strong>Sub-category: </strong> ' . $data['sub_category'] .'<br><strong>Priority: </strong> '. $data['priority'] . '</p>  
                    <p>'. nl2br($data["description"]).'</p><br>
                    <p>Click the button below for details of the ticket from IMS Ticketing:</p>
                    <a href="'. $uri .'" class="button">View Details</a><br>
                    <p>If the button is not working for you, be sure to use the link below</p>
                    <p>'.$uri.'</p><br>
                    <p>Thank you!</p>
                </div>
                <div class="footer">
                    &copy; 2025 APS Wallet IMS Ticketing | All Rights Reserved
                </div>
            </div>
        </body>
        </html>
        ';
    }

}
