<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Form\Type\AuthorType;
use App\Form\Type\BookType;
use App\Form\Type\PublisherType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class EditController implements ApiAwareInterface
{
    use ApiAwareTrait;

    private $router;
    private $formFactory;
    private $manager;
    private $twig;

    public function __construct(
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $manager,
        Environment $twig
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->manager = $manager;
        $this->twig = $twig;
    }

    /**
     * @ParamConverter("author", class="App\Entity\Author")
     */
    public function editAuthorAction(Request $request, Author $author): Response
    {
        $form = $this->formFactory->create(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->put('/authors', ['author' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_author'));
        }

        return new Response($this->twig->render('create_author.html.twig', ['form' => $form->createView()]));
    }

    /**
     * @ParamConverter("book", class="App\Entity\Book")
     */
    public function editBookAction(Request $request, Book $book): Response
    {
        $form = $this->formFactory->create(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->put('/books', ['book' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_book'));
        }

        return new Response($this->twig->render('create_book.html.twig', ['form' => $form->createView()]));
    }

    /**
     * @ParamConverter("publisher", class="App\Entity\Publisher")
     */
    public function editPublisherAction(Request $request, Publisher $publisher): Response
    {
        $form = $this->formFactory->create(PublisherType::class, $publisher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->put('/publishers', ['publisher' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_publisher'));
        }

        return new Response($this->twig->render('create_publisher.html.twig', ['form' => $form->createView()]));
    }
}
