<?php

namespace App\Handler;

use App\Message\UserCreated;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MyMessageHandler implements MessageHandlerInterface
{
    public function __invoke(UserCreated $message)
    {
        echo "Message received!\n\n";
//        dump($message->getData());
        throw new UnrecoverableMessageHandlingException('This message should not be retried');
    }
}
