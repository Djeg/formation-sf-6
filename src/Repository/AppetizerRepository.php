<?php

namespace App\Repository;

use App\Entity\Appetizer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Appetizer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appetizer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appetizer[]    findAll()
 * @method Appetizer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppetizerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appetizer::class);
    }

    // /**
    //  * @return Appetizer[] Returns an array of Appetizer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appetizer
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
