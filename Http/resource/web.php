<?php

use http\controller\Auth\session\SignedController;
use http\controller\dashboard\DashboardController;
use http\controller\ticketing\TicketingController;
use http\controller\Auth\session\SessionController;
use http\controller\Auth\session\UserSessionController;
use http\controller\Auth\registration\RegisterController;
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

# Ticketing controller 
$router->get('/ticketing', [TicketingController::class, 'index'])->only('auth');
$router->get('/admin/ticketing', [TicketingController::class, 'adminIndex'])->only('auth');
$router->get('/new/ticket', [TicketingController::class, 'newTicket'])->only('auth');
$router->get('/status/ticket', [TicketingController::class, 'status'])->only('auth');
$router->get('/admin/status/ticket', [TicketingController::class, 'AdminStatus'])->only('auth');

$router->post('/saved/ticket', [TicketingController::class, 'store'])->only('auth');
$router->patch('/admin/saved/ticket', [TicketingController::class, 'update'])->only('auth');
$router->delete('/admin/delete/ticket', [TicketingController::class, 'destroy'])->only('auth');

// mobifin ticketing
$router->get('/mobifin/new/ticket', [MobifinTicketingController::class, 'new'])->only('auth');
$router->get('/mobifin/category/ticket', [MobifinTicketingController::class, 'category'])->only('auth');

$router->post('/mobifin/category/add', [MobifinTicketingController::class, 'store'])->only('auth');
$router->post('/mobifin/ticket/save', [MobifinTicketingController::class, 'storeTicket'])->only('auth');


$router->delete('/mobifin/category/delete', [MobifinTicketingController::class, 'destroyCategory'])->only('auth');
$router->delete('/mobifin/subcategory/delete', [MobifinTicketingController::class, 'destroySubCategory'])->only('auth');