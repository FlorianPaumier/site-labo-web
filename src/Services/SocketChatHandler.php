<?php


namespace App\Services;


use React\EventLoop\Factory;
use React\Socket\Connection;
use React\Socket\ConnectionInterface;
use React\Socket\Server;

class SocketChatHandler
{
    /**
     * @var Server
     */
    private $socket;

    /**
     * @var \React\EventLoop\LoopInterface
     */
    private $loop;

    /**
     * @var \SplObjectStorage
     */
    private $connections;

    public function __construct($host = "127.0.0.1", $port = "8002")
    {
        //$this->loop = Factory::create();
        //$this->socket = new Server($host.":".$port, $this->loop);
    }

    public function instance(){

    }

    public function write(){

    }

    public function run(){
        $this->loop->run();
    }

    public function stop(){
        $this->socket->close();
        $this->loop->stop();
    }
}
