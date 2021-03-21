<?php

namespace App\Controller;

use App\API\ApiObjectBus;
use App\API\Object\AuthorApiObject;
use App\API\Object\BookApiObject;
use App\API\Object\PublisherApiObject;
use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RemoveController
{
    private $router;
    private $manager;
    private $bus;

    public function __construct(RouterInterface $router, EntityManagerInterface $manager, ApiObjectBus $bus)
    {
        $this->router = $router;
        $this->manager = $manager;
        $this->bus = $bus;
    }

    /**
     * @ParamConverter("author", class="App\Entity\Author")
     */
    public function removeAuthorAction(Author $author): Response
    {
        $this->manager->remove($author);
        $this->manager->flush();

        $this->bus->push(new AuthorApiObject('DELETE', '/authors', $author));

        return new RedirectResponse($this->router->generate('list_author'));
    }

    /**
     * @ParamConverter("book", class="App\Entity\Book")
     */
    public function removeBookAction(Book $book): Response
    {
        $this->manager->remove($book);
        $this->manager->flush();

        $this->bus->push(new BookApiObject('PUT', '/books', $book));

        return new RedirectResponse($this->router->generate('list_book'));
    }

    /**
     * @ParamConverter("publisher", class="App\Entity\Publisher")
     */
    public function removePublisherAction(Publisher $publisher): Response
    {
        $this->manager->remove($publisher);
        $this->manager->flush();

        $this->bus->push(new PublisherApiObject('DELETE', '/publishers', $publisher));

        return new RedirectResponse($this->router->generate('list_publisher'));
    }
}
