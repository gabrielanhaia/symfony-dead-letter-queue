<?php

namespace App\Handler;

use App\Message\UserCreated;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

#[AsMessageHandler]
class MyMessageHandler
{
    public function __invoke(UserCreated $message): void
    {
        echo "Message received!\n\n";
        throw new UnrecoverableMessageHandlingException('This message should not be retried');
    }
}
