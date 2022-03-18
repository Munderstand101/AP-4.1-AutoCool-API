<?php

namespace App\Repository;

use App\Entity\FactureKM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FactureKM|null find($id, $lockMode = null, $lockVersion = null)
 * @method FactureKM|null findOneBy(array $criteria, array $orderBy = null)
 * @method FactureKM[]    findAll()
 * @method FactureKM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureKMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FactureKM::class);
    }

    // /**
    //  * @return FactureKM[] Returns an array of FactureKM objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FactureKM
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
