<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function findVehicleLieuVilleByCateg(string $categ) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT vehicule.id, lieu.libelle as libelle_lieu, ville.libelle as libelle_ville
				FROM vehicule
				JOIN lieu ON lieu.id = vehicule.lieu_id
				JOIN ville ON ville.id = lieu.ville_id
				JOIN type_vehicule ON type_vehicule.id = vehicule.type_vehicule_id
				JOIN categorie_vehicule ON categorie_vehicule.id = type_vehicule.categorie_vehicule_id
				where categorie_vehicule.libelle = ?';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $categ);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function findVehicleLieuVilleById(int $id) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT vehicule.id, vehicule.libelle, vehicule.kilometrage, vehicule.niveau_essence, 
       vehicule.nb_place, vehicule.est_automatique, 
       lieu.libelle as libelle_lieu, lieu.id as lieu_id,
       ville.libelle as libelle_ville, ville.id as ville_id, 
       type_vehicule.libelle as libelle_type,   type_vehicule.id as type_id, 
       categorie_vehicule.libelle as libelle_categorie, categorie_vehicule.id as categorie_id
        FROM vehicule
        JOIN lieu ON lieu.id = vehicule.lieu_id
        JOIN ville ON ville.id = lieu.ville_id
        JOIN type_vehicule ON type_vehicule.id = vehicule.type_vehicule_id
        JOIN categorie_vehicule ON categorie_vehicule.id = type_vehicule.categorie_vehicule_id
        where vehicule.id = ?';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function findAllVehicleLieuVilleByTop(int $top) : array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT TOP(?) vehicule.id, vehicule.libelle, vehicule.kilometrage, vehicule.niveau_essence, 
       vehicule.nb_place, vehicule.est_automatique, lieu.libelle as libelle_lieu,  
       ville.libelle as libelle_ville, type_vehicule.libelle as libelle_type, 
       categorie_vehicule.libelle as libelle_categorie
        FROM vehicule
        JOIN lieu ON lieu.id = vehicule.lieu_id
        JOIN ville ON ville.id = lieu.ville_id
        JOIN type_vehicule ON type_vehicule.id = vehicule.type_vehicule_id
        JOIN categorie_vehicule ON categorie_vehicule.id = type_vehicule.categorie_vehicule_id';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $top);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Vehicule[] Returns an array of Vehicule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
