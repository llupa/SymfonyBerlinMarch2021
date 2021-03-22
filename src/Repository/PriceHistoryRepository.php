<?php

namespace App\Repository;

use App\Entity\PriceHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriceHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceHistory[]    findAll()
 * @method PriceHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceHistory::class);
    }

    /**
     * @return PriceHistory[] Returns an array of PriceHistory objects
     */
    public function findByBook($value)
    {
        return $this->createQueryBuilder('price_history')
            ->andWhere('price_history.book.isbn = :val')
            ->setParameter('val', $value)
            ->orderBy('price_history.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?PriceHistory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
