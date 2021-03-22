<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\PriceHistoryRepository;
use App\Repository\PublisherRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ListController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function listAuthorAction(AuthorRepository $repository): Response
    {
        return new Response($this->twig->render('list_author.html.twig', ['data' => $repository->findAll()]));
    }

    public function listBookAction(BookRepository $repository): Response
    {
        return new Response($this->twig->render('list_book.html.twig', ['data' => $repository->findAll()]));
    }

    public function listPriceHistoryAction(PriceHistoryRepository $repository, $id): Response
    {
        return new Response($this->twig->render('list_price_history.html.twig', ['data' => $repository->findByBook($id)]));
    }

    public function listPublisherAction(PublisherRepository $repository): Response
    {
        return new Response($this->twig->render('list_publisher.html.twig', ['data' => $repository->findAll()]));
    }
}
