<?php
namespace App\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class MessageHandler implements MessageComponentInterface
{

    protected $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage;
    }
    public function onOpen(ConnectionInterface $conn): void
    {
        $this->connections->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
        foreach($this->connections as $connection)
        {
            if($connection === $from)
            {
                continue;
            }
            $connection->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e): void
    {
        $this->connections->detach($conn);
        $conn->close();
    }
}