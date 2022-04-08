<?php

namespace App\Repository;

use App\Entity\Abonne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Abonne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Abonne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Abonne[]    findAll()
 * @method Abonne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abonne::class);
    }

    public function findAbonneAndDateById(int $id) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT A.*, AD.dateAdhesion
            FROM abonne AS A inner join adhere AS AD on A.id = AD.abonne_id
            WHERE A.id = ?;
            ';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $resultSet = $stmt->executeQuery();
      
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Abonne[] Returns an array of Abonne objects
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
    public function findOneBySomeField($value): ?Abonne
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
