<?php

namespace App\Serializer;

use App\Message\UserCreated;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class MyMessageSerializer implements SerializerInterface
{
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        if (!$message instanceof UserCreated) {
            throw new \InvalidArgumentException('MyMessageSerializer supports only instances of MyMessage');
        }

        $data = $message->getData();

        return [
            'body' => json_encode($data),
            'headers' => ['type' => UserCreated::class],
        ];
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        $data = json_decode($encodedEnvelope['body'], true);

        if ($encodedEnvelope['headers']['type'] !== UserCreated::class) {
            throw new \InvalidArgumentException('MyMessageSerializer supports only instances of MyMessage');
        }

        $message = new UserCreated($data);

        return new Envelope($message);
    }
}
