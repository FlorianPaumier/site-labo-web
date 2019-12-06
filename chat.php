<?php

use App\Services\SocketChatHandler;

require __DIR__ . '/vendor/autoload.php';

$socket = new SocketChatHandler();
$socket->instance();
$socket->run();