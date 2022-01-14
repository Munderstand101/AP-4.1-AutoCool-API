<?php

namespace App\Repository;

use App\Entity\TrancheHoraire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrancheHoraire|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrancheHoraire|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrancheHoraire[]    findAll()
 * @method TrancheHoraire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrancheHoraireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrancheHoraire::class);
    }

    // /**
    //  * @return TrancheHoraire[] Returns an array of TrancheHoraire objects
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
    public function findOneBySomeField($value): ?TrancheHoraire
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
