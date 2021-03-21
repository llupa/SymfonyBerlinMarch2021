<?php

namespace App\API\Object;

use App\Entity\Publisher;

class PublisherApiObject implements ApiObjectInterface
{
    private $type;
    private $uri;
    private $publisher;

    public function __construct(string $type, string $uri, Publisher $publisher)
    {
        $this->type      = $type;
        $this->uri       = $uri;
        $this->publisher = $publisher;
    }

    public function getPayload(): array
    {
        return ['publisher' => $this->publisher];
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
