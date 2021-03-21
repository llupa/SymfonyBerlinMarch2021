<?php

namespace App\API\Object;

use App\Entity\Book;

class BookApiObject implements ApiObjectInterface
{
    private $type;
    private $uri;
    private $book;

    public function __construct(string $type, string $uri, Book $book)
    {
        $this->type   = $type;
        $this->uri    = $uri;
        $this->book = $book;
    }

    public function getPayload(): array
    {
        return ['book' => $this->book];
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
