<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RemoveController implements ApiAwareInterface
{
    use ApiAwareTrait;

    private $router;
    private $manager;

    public function __construct(RouterInterface $router, EntityManagerInterface $manager)
    {
        $this->router = $router;
        $this->manager = $manager;
    }

    /**
     * @ParamConverter("author", class="App\Entity\Author")
     */
    public function removeAuthorAction(Author $author): Response
    {
        $this->manager->remove($author);
        $this->manager->flush();

        $this->api->delete('/authors', ['author' => $author]);

        return new RedirectResponse($this->router->generate('list_author'));
    }

    /**
     * @ParamConverter("book", class="App\Entity\Book")
     */
    public function removeBookAction(Book $book): Response
    {
        $this->manager->remove($book);
        $this->manager->flush();

        $this->api->delete('/books', ['book' => $book]);

        return new RedirectResponse($this->router->generate('list_book'));
    }

    /**
     * @ParamConverter("publisher", class="App\Entity\Publisher")
     */
    public function removePublisherAction(Publisher $publisher): Response
    {
        $this->manager->remove($publisher);
        $this->manager->flush();

        $this->api->delete('/publishers', ['publisher' => $publisher]);

        return new RedirectResponse($this->router->generate('list_publisher'));
    }
}
