<?php

namespace App\Repository;

use App\Entity\TrancheKm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrancheKm|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrancheKm|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrancheKm[]    findAll()
 * @method TrancheKm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrancheKmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrancheKm::class);
    }

    // /**
    //  * @return TrancheKm[] Returns an array of TrancheKm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrancheKm
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
