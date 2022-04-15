<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function createAbonneAndAdherent(String $nom, String $prenom,String $datenaiss,String $rue,String $ville,String $codepostal, String $telfixe, String $telmobile,String $email, String $num_permis, String $lieu_permis, String $date_permis, String $paiement_adhesion, String $paiement_caution, String $rib_fourni, String $civilite, String $idFormule, String $dateAdhesion)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "INSERT INTO abonne (nom, prenom, date_naissance, rue, ville, code_postal, tel, tel_mobile, email, num_permis, lieu_permis, date_permis, paiement_adhesion, paiement_caution, rib_fourni, civilite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $nom);
        $stmt->bindValue(2, $prenom);
        $stmt->bindValue(3, $datenaiss);
        $stmt->bindValue(4, $rue);
        $stmt->bindValue(5, $ville);
        $stmt->bindValue(6, $codepostal);
        $stmt->bindValue(7, $telfixe);
        $stmt->bindValue(8, $telmobile);
        $stmt->bindValue(9, $email);
        $stmt->bindValue(10, $num_permis);
        $stmt->bindValue(11, $lieu_permis);
        $stmt->bindValue(12, $date_permis);
        $stmt->bindValue(13, $paiement_adhesion);
        $stmt->bindValue(14, $paiement_caution);
        $stmt->bindValue(15, $rib_fourni);
        $stmt->bindValue(16, $civilite);
        $resultSet = $stmt->executeQuery();

        $sql2 = "SELECT id FROM abonne ORDER BY id DESC LIMIT 1";
        $stmt2 = $conn->prepare($sql2);
        $resultSet2 = $stmt2->executeQuery();

        foreach ($resultSet2->fetch() as $leId) {
            $nb = $leId;
        }

        $sql3 = "INSERT INTO adhere
        VALUES (?, ?, ?)";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bindValue(1, $leId);
        $stmt3->bindValue(2, $idFormule);
        $stmt3->bindValue(3, $dateAdhesion);
        $resultSet3 = $stmt3->executeQuery();
      
        // returns an array of arrays (i.e. a raw data set)
        return $resultSet3->fetchAllAssociative();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
