<?php

namespace http\controller\ticketing;

use core\Session;
use core\Response;
use core\Paginator;
use core\UploadImg;
use core\MailSender;
use core\Authenticator;
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
            'heading' => 'New MPR (Mobifin Platform Requests)',
            'instruction' => 'Send a new ticket request that relates to mobifin platform.',
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
        return view('ticketing/mobifin/categories.mobifin.view', [
            'title' => 'MPR category',
            'errors' => Session::get('errors'),
            'heading' => 'MPR Categories',
            'instruction' => 'Add categories and sub-categories for new ticket request that relates to mobifin platform.',
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
            'classification' => sanitize($_POST['classification']),
            'category' => sanitize($_POST['category']), 
            'sub_category' => sanitize($_POST['sub_category']),       
            'department' => sanitize($_POST['department']),
            'source' => sanitize($_POST['source']),
            'discription' => sanitize($_POST['discription']),
            'ticketId' => sanitize($_POST['ticketId']),
            'make_at' => cur_time(),
            'maker_id' => Session::user(),
            'host' => ($_POST['host']),
            'priority' => ($_POST['priority']),
            'email' => ($_POST['email']),
            'ticket_channel' => ($_POST['ticket_channel']),
        ],
        [
            'classification' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'department' => 'required',
            'discription' => 'required',
            'priority' => 'required'
        ]);

        $data['file_path'] = UploadImg::saveFile($instance);

        if (TicketingModel::getTicketId($data['ticketId'])) {

            $instance->error(
                'classification', 'TICKET ID for your request alreday exit, kindly refresh and try again.'
            )->throw();
        }
        

        Authenticator::save('APS_ticketing', $data); 
        
        MailSender::sendEmail(ModelData::addUserEmail(), 'APS Wallet MPR Ticketing_id: '. $data['ticketId'], 'view/template/mailTemplate.php');
        
        Session::flash('success', 'Request sent successfully');
        return redirect('/mobifin/new/ticket');
        

    }
}