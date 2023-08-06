<?php

namespace App\Message;

use Serializable;

class MyMessage implements Serializable
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function serialize(): ?string
    {
        return serialize($this->data);
    }

    public function unserialize(string $data): void
    {
        $this->data = unserialize($data);
    }

    public function __serialize(): array
    {
        return ['data' => $this->data];
    }

    public function __unserialize(array $data): void
    {
        $this->data = $data['data'];
    }
}