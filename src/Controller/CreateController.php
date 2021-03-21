<?php

namespace App\Controller;

use App\API\ApiObjectBus;
use App\API\Object\AuthorApiObject;
use App\API\Object\BookApiObject;
use App\API\Object\PublisherApiObject;
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

class CreateController
{
    private $router;
    private $formFactory;
    private $manager;
    private $twig;
    private $bus;

    public function __construct(
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $manager,
        Environment $twig,
        ApiObjectBus $bus
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->manager = $manager;
        $this->twig = $twig;
        $this->bus = $bus;
    }

    public function createAuthorAction(Request $request): Response
    {
        $form = $this->formFactory->create(AuthorType::class, new Author());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getNormData());
            $this->manager->flush();

            $this->bus->push(new AuthorApiObject('POST', '/authors', $form->getNormData()));

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

            $this->bus->push(new BookApiObject('POST', '/books', $form->getNormData()));

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

            $this->bus->push(new PublisherApiObject('POST', '/publishers', $form->getNormData()));

            return new RedirectResponse($this->router->generate('list_publisher'));
        }

        return new Response($this->twig->render('create_publisher.html.twig', ['form' => $form->createView()]));
    }
}
