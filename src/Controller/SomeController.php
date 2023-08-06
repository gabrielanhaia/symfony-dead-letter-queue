<?php

namespace App\Controller;

use App\Message\UserCreated;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/test', name: 'test')]
    public function sendMessage(): Response
    {
        $messageData = [
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'name' => 'John Doe',
            'email' => 'john.doe@test.com',
        ];
        $message = new UserCreated($messageData);
        $this->messageBus->dispatch($message);

        return new Response('Message sent!');
    }
}
