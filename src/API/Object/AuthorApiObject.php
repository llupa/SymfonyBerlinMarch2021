<?php

namespace App\API\Object;

use App\Entity\Author;

class AuthorApiObject implements ApiObjectInterface
{
    private $type;
    private $uri;
    private $author;

    public function __construct(string $type, string $uri, Author $author)
    {
        $this->type   = $type;
        $this->uri    = $uri;
        $this->author = $author;
    }

    public function getPayload(): array
    {
        return ['author' => $this->author];
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
