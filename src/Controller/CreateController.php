<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Form\Type\AuthorType;
use App\Form\Type\BookType;
use App\Form\Type\PublisherType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class CreateController implements ApiAwareInterface
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

    public function createAuthorAction(Request $request): Response
    {
        $form = $this->formFactory->create(AuthorType::class, new Author());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->post('/authors', ['author' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_author'));
        }

        return new Response($this->twig->render('create_author.html.twig', ['form' => $form->createView()]));
    }

    public function createBookAction(Request $request): Response
    {
        $form = $this->formFactory->create(BookType::class, new Book());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->post('/books', ['book' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_book'));
        }

        return new Response($this->twig->render('create_book.html.twig', ['form' => $form->createView()]));
    }

    public function createPublisherAction(Request $request): Response
    {
        $form = $this->formFactory->create(PublisherType::class, new Publisher());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->api->post('/publishers', ['publisher' => $form->getNormData()]);

            return new RedirectResponse($this->router->generate('list_publisher'));
        }

        return new Response($this->twig->render('create_publisher.html.twig', ['form' => $form->createView()]));
    }
}
