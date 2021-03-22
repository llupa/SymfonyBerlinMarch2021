<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use function is_a;

/**
 * @ORM\Embeddable()
 */
class BookInfo
{
    /**
     * @ORM\Column(type="string")
     */
    private $isbn;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    public function __construct(Book $book)
    {
        $this->isbn  = (string) $book->getIsbn();
        $this->title = (string) $book->getTitle();
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function equals($other): bool
    {
        if (!is_a($other, BookInfo::class)) {
            return false;
        }

        return $this->getIsbn() == $other->getIsbn();
    }
}
