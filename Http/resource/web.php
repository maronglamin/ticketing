<?php

use Http\controller\Clockins\ClockinsController;
use Http\controller\Auth\session\SignedController;
use Http\controller\dashboard\DashboardController;
use Http\controller\ticketing\TicketingController;
use Http\controller\Auth\session\SessionController;
use Http\controller\Clockins\ClockinsByDateController;
use Http\controller\student\RegisterStudentController;
use Http\controller\Auth\session\UserSessionController;
use Http\controller\transactions\TransactionController;
use Http\controller\Auth\registration\RegisterController;
 

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

# dashboard controller.
$router->get('/dashboard', [DashboardController::class, 'index'])->only('auth');

#session user roles
$router->get('/session/user/role', [UserSessionController::class, 'index'])->only('auth');

$router->patch('/session/user/role', [UserSessionController::class, 'store'])->only('auth');
$router->get('/calender/year', [CalenderController::class, 'index'])->only('auth');
$router->get('/calender/edit', [CalenderController::class, 'edit'])->only('auth');
$router->get('/calender/confirm', [CalenderController::class, 'confirm'])->only('auth');

# transaction 
$router->get('/transaction/journal', [TransactionController::class, 'journal'])->only('auth');

# Ticketing controller 
$router->get('/ticketing', [TicketingController::class, 'index'])->only('auth');
$router->get('/admin/ticketing', [TicketingController::class, 'adminIndex'])->only('auth');
$router->get('/new/ticket', [TicketingController::class, 'newTicket'])->only('auth');
$router->get('/status/ticket', [TicketingController::class, 'status'])->only('auth');
$router->get('/admin/status/ticket', [TicketingController::class, 'AdminStatus'])->only('auth');

$router->post('/saved/ticket', [TicketingController::class, 'store'])->only('auth');
$router->patch('/admin/saved/ticket', [TicketingController::class, 'update'])->only('auth');
$router->delete('/admin/delete/ticket', [TicketingController::class, 'destroy'])->only('auth');

# clock-ins 
$router->get('/clock-ins/in', [ClockinsController::class, 'index'])->only('auth');
$router->post('/clock-ins/in/send', [ClockinsController::class, 'store'])->only('auth');
$router->get('/clock-ins/out', [ClockinsController::class, 'clockout'])->only('auth');

$router->get('/clock-ins/track', [ClockinsController::class, 'list'])->only('auth');
$router->get('/clock-ins/tracking', [ClockinsController::class, 'show'])->only('auth');

$router->get('/clock-ins/track/previous', [ClockinsController::class, 'previousDate'])->only('auth');
$router->get('/clock-ins/previousDayReactions', [ClockinsController::class, 'showPreciousDay'])->only('auth');

$router->patch('/clock-ins/previousReactions', [ClockinsController::class, 'savePreciousDay'])->only('auth');
$router->patch('/clock-ins/reactions', [ClockinsController::class, 'save'])->only('auth');
$router->patch('/clock-ins/out/send', [ClockinsController::class, 'update'])->only('auth');
$router->delete('/clock-ins/delete', [ClockinsController::class, 'destroy'])->only('auth');

$router->get('/clock-ins/bydate', [ClockinsByDateController::class, 'index'])->only('auth');
$router->get('/clock-ins/byDateReactions', [ClockinsByDateController::class, 'showByDate'])->only('auth');

$router->post('/clock-ins/bydate/search', [ClockinsByDateController::class, 'search'])->only('auth');
$router->patch('/clock-ins/byDateReactions', [ClockinsByDateController::class, 'saveByDate'])->only('auth');



