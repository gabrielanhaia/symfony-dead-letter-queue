<?php

namespace App\Controller;

use App\MyMessage; // Fix the namespace here
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/test', name: 'test')]
    public function sendMessage(): Response
    {
        $messageData = ['foo' => 'bar']; // Replace this with your message data
        $message = new MyMessage($messageData);
        $this->messageBus->dispatch($message);

        return new Response('Message sent!');
    }
}
