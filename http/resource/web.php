<?php

use http\controller\BankNoteController;
use http\controller\BankCloseController;
use http\controller\DepartmentController;
use http\controller\SignatureUserController;
use http\controller\TransactionHistoryController;
use http\controller\Auth\session\SignedController;
use http\controller\dashboard\DashboardController;
use http\controller\ticketing\TicketingController;
use http\controller\Auth\session\SessionController;
use http\controller\ticketing\CheckStatusController;
use http\controller\Auth\session\UserSessionController;
use http\controller\BankInstruction\BankListController;
use http\controller\Emails\EmailNotificationController;
use http\controller\Auth\registration\RegisterController;
use http\controller\callcenter\CustomerServiceController;
use http\controller\ticketing\MobifinTicketingController;



$router->get('/', [SessionController::class, 'index'])->only('guess');
$router->post('/session', [SessionController::class, 'store']);
$router->delete('/session', [SessionController::class, 'destroy'])->only('auth');

$router->get('/session/create', [RegisterController::class, 'create'])->only('guess');
$router->get('/session/user/password', [RegisterController::class, 'index'])->only('auth');

$router->post('/sessions', [RegisterController::class, 'store']);
$router->patch('/session/user/password/update', [RegisterController::class, 'update'])->only('auth');

$router->get('/session/users', [SignedController::class, 'index'])->only('auth');
$router->get('/session/summary', [SignedController::class, 'edit'])->only('auth');
$router->get('/session/maintenance', [SignedController::class, 'create'])->only('auth');

$router->post('/session/users', [SignedController::class, 'search'])->only('auth');
$router->post('/session/users/create', [SignedController::class, 'store'])->only('auth');

$router->patch('/session/users/save', [SignedController::class, 'save'])->only('auth');
$router->patch('/session/users/update', [SignedController::class, 'update'])->only('auth');
$router->delete('/session/users/delete', [SignedController::class, 'destroy'])->only('auth');

#session user roles
$router->get('/session/user/role', [UserSessionController::class, 'index'])->only('auth');
$router->patch('/session/user/role', [UserSessionController::class, 'store'])->only('auth');

# dashboard controller.
$router->get('/dashboard', [DashboardController::class, 'index'])->only('auth');
$router->get('/reports', [DashboardController::class, 'filters'])->only('auth');

# Ticketing controller 
$router->get('/aps-request', [TicketingController::class, 'index'])->only('auth');
$router->get('/admin/ticketing', [TicketingController::class, 'adminIndex'])->only('auth');
$router->get('/new/ticket', [TicketingController::class, 'newTicket'])->only('auth');
$router->get('/status/ticket', [TicketingController::class, 'status'])->only('auth');
$router->get('/admin/status/ticket', [TicketingController::class, 'AdminStatus'])->only('auth');

$router->post('/saved/ticket', [TicketingController::class, 'store'])->only('auth');
// each user can update the ticket status.
$router->post('/status/change', [TicketingController::class, 'statusChange'])->only('auth');

$router->patch('/admin/saved/ticket', [TicketingController::class, 'update'])->only('auth');
$router->delete('/admin/delete/ticket', [TicketingController::class, 'destroy'])->only('auth');

// mobifin ticketing
$router->get('/mobifin/new/ticket', [MobifinTicketingController::class, 'new'])->only('auth');
$router->get('/mobifin/category/ticket', [MobifinTicketingController::class, 'category'])->only('auth');

$router->post('/mobifin/category/add', [MobifinTicketingController::class, 'store'])->only('auth');
$router->post('/new/ticket/save', [MobifinTicketingController::class, 'storeRaiseTicket'])->only('auth');


$router->delete('/mobifin/category/delete', [MobifinTicketingController::class, 'destroyCategory'])->only('auth');
$router->delete('/mobifin/subcategory/delete', [MobifinTicketingController::class, 'destroySubCategory'])->only('auth');

$router->get('/email/queued', [EmailNotificationController::class, 'queued'])->only('auth');

$router->get('/operations/checklist/new', [CheckStatusController::class, 'newTicketStatus'])->only('auth');
$router->get('/operations/checklist/onhold', [CheckStatusController::class, 'onHoldTicketStatus'])->only('auth');
$router->get('/operations/checklist/inprogress', [CheckStatusController::class, 'inprogressTicketStatus'])->only('auth');
$router->get('/operations/checklist/resolved', [CheckStatusController::class, 'resolvedTicketStatus'])->only('auth');
$router->get('/operations/checklist/closed', [CheckStatusController::class, 'closedTicketStatus'])->only('auth');
$router->get('/operations/checklist/cancelled', [CheckStatusController::class, 'cancelledTicketStatus'])->only('auth');


$router->get('/department/list', [DepartmentController::class, 'index'])->only('auth');
$router->post('/department/create/new', [DepartmentController::class, 'store'])->only('auth');



$router->get('/callcenter/logs', [CustomerServiceController::class, 'index'])->only('auth');
$router->post('/callcenter/save/customerDetail', [CustomerServiceController::class, 'store'])->only('auth');

// operations task controllers
$router->get('/transaction/history', [TransactionHistoryController::class, 'index'])->only('auth');
$router->get('/transaction/data', [TransactionHistoryController::class, 'transactionData'])->only('auth');
$router->get('/addmoney/transaction', [TransactionHistoryController::class, 'addMoney'])->only('auth');

$router->post('/addmoney/new', [TransactionHistoryController::class, 'storeAddMoney'])->only('auth');
$router->post('/create/money/new', [TransactionHistoryController::class, 'storeCreateMoney'])->only('auth');
$router->post('/kill/money/new', [TransactionHistoryController::class, 'storeKillMoney'])->only('auth');

$router->get('/add/money/new', [TransactionHistoryController::class, 'addMoney'])->only('auth');
$router->get('/create/money/new', [TransactionHistoryController::class, 'createMoney'])->only('auth');
$router->get('/kill/money/new', [TransactionHistoryController::class, 'killMoney'])->only('auth');

$router->get('/view/transaction/data', [TransactionHistoryController::class, 'viewTransactionData'])->only('auth');
$router->get('/edit/transaction/data', [TransactionHistoryController::class, 'editTransactionData'])->only('auth');

$router->post('/edit/transaction/details', [TransactionHistoryController::class, 'storeEditedTransaction'])->only('auth');

$router->patch('/transaction/review', [TransactionHistoryController::class, 'review'])->only('auth');
$router->patch('/transaction/reject', [TransactionHistoryController::class, 'reject'])->only('auth');
$router->patch('/transaction/approval', [TransactionHistoryController::class, 'approve'])->only('auth');

// Bank Notes
$router->get('/instrustions/bank/note', [BankNoteController::class, 'instruction'])->only('auth');
$router->get('/instrustions/new', [BankNoteController::class, 'new'])->only('auth');
$router->get('/instrustions/view/details', [BankNoteController::class, 'viewInstrustions'])->only('auth');
$router->get('/instrustions/view/print', [BankNoteController::class, 'printInstrustions'])->only('auth');
$router->get('/instrustions/edit', [BankNoteController::class, 'editInstrustions'])->only('auth');

$router->get('/signatures/bank/note', [SignatureUserController::class, 'index'])->only('auth');


$router->post('/instruct/new/add', [BankNoteController::class, 'store'])->only('auth');
$router->post('/instruct/update/banknote', [BankNoteController::class, 'update'])->only('auth');

$router->patch('/instruction/review', [BankNoteController::class, 'review'])->only('auth');
$router->patch('/instruction/reject', [BankNoteController::class, 'reject'])->only('auth');
$router->patch('/instruction/approve', [BankNoteController::class, 'approve'])->only('auth');

$router->patch('/reviewer/sign/authority', [BankNoteController::class, 'RevSign'])->only('auth');
$router->patch('/approver/sign/authority', [BankNoteController::class, 'ApproveSign'])->only('auth');

$router->patch('/instruction/bank/officer', [BankNoteController::class, 'player'])->only('auth');

// create bank list for bank taking care of the instructions
$router->get('/settlement/bank/list', [BankListController::class, 'index'])->only('auth');

// post request
$router->post('/settlement/bank/save', [BankListController::class, 'store'])->only('auth');
$router->delete('/settlement/bank/delete', [BankListController::class, 'delete'])->only('auth');

$router->get('/user/bank/note', [BankCloseController::class, 'index'])->only('auth');

