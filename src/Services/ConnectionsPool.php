<?php


namespace App\Services;


use React\Socket\ConnectionInterface;

class ConnectionsPool
{

    /**
     * @var \SplObjectStorage
     */
    private $connections;

    public function __construct()
    {
        $this->connections = new \SplObjectStorage();
    }

    public function add(ConnectionInterface $connection)
    {
        $this->connections->attach($connection);
    }
}