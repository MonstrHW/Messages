<?php

/*
+ GET /messages - messages.index

+ GET /messages/{id} - messages.show

+ GET /messages/create - messages.create
+ POST /messages - messages.store

+ GET /messages/{id}/edit - messages.edit
+ POST /messages/{id} - messages.update

+ POST /messages/{id}/comments - comments.store
*/

require __DIR__ . '/router.php';

require __DIR__ . '/Controllers/MessageController.php';
require __DIR__ . '/Controllers/CommentController.php';

require __DIR__ . '/Models/Message.php';
require __DIR__ . '/Models/Comments.php';

require __DIR__ . '/Services/MessageService.php';
require __DIR__ . '/Services/CommentService.php';

require __DIR__ . '/helpers.php';
require __DIR__ . '/db.php';

Router::get('/', function () {
	redirect('/messages');
});

Router::get('/messages', [MessageController::class, 'index'], 'messages.index');
Router::get('/messages/*', [MessageController::class, 'show'], 'messages.show');

Router::get('/messages/create', [MessageController::class, 'create'], 'messages.create');
Router::post('/messages', [MessageController::class, 'store'], 'messages.store');

Router::get('/messages/*/edit', [MessageController::class, 'edit'], 'messages.edit');
Router::post('/messages/*', [MessageController::class, 'update'], 'messages.update');

Router::post('/messages/*/comments', [CommentController::class, 'store'], 'comments.store');

Router::handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

DB::close();
