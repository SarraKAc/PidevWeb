<?php

namespace App\Repository;
use Doctrine\DBAL\Connection;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use phpDocumentor\Reflection\Types\Float_;


/**
 * @extends ServiceEntityRepository<Service>
 *
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {        parent::__construct($registry, Service::class);
                $this->entityManager = $entityManager;

    }
    public function calculerPromo()
    {
        $entityManager = $this->getEntityManager();
        $connection = $entityManager->getConnection();

        $sql = "SELECT s.id_service, " .
            "s.prix, " .
            "SUM(a.nbr_etoile) / COUNT(*) as avg_rating_per_service, " .
            "s.PrixSolde " .
            "FROM service s " .
            "JOIN avis a ON s.id_service = a.id_service " .
            "GROUP BY s.id_service, s.prix, s.PrixSolde";

        try {
            $result = $connection->executeQuery($sql);
            $promotions = $result->fetchAllAssociative();

            foreach ($promotions as $promotion) {
                $id_service = $promotion['id_service'];
                $prix = $promotion['prix'];
                $rating = $promotion['avg_rating_per_service'];

                // Calculer le nouveau prix en fonction du rating
                $nouveau_prix = $prix; // Initialisez-le avec le prix actuel par défaut

                if ($rating < 5) {
                    if ($rating > 0 && $rating <= 2) {
                        $nouveau_prix = $prix * (1 - 0.3);
                    } elseif ($rating > 2 && $rating <= 3) {
                        $nouveau_prix = $prix * (1 - 0.25);
                    } elseif ($rating > 3 && $rating <= 4) {
                        $nouveau_prix = $prix * (1 - 0.2);
                    }
                }

                // Mettre à jour le prix solde dans la base de données
                $req = "UPDATE service SET PrixSolde = ? WHERE id_service = ?";
                $connection->executeUpdate($req, array($nouveau_prix, $id_service));
            }



        } catch (\Exception $e) {
            // Gérer les exceptions ici
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }



    public function desactivePromo()
    {
        $entityManager = $this->getEntityManager();
        $connection = $entityManager->getConnection();

        $sql = "ALTER TABLE service DROP COLUMN PrixSolde;";
        $req = "ALTER TABLE service ADD COLUMN PrixSolde FLOAT NULL;";

        try {
            $connection->executeUpdate($sql);
            $connection->executeUpdate($req);
        } catch (\Exception $e) {
            // Gérer les exceptions ici
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }


//    /**
//     * @return Author[] Returns an array of Author objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Author
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

//Query Builder: Question 1
public function showAllServicesOrderByNom()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.nom_service','DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function searchByKeyword(string $keyword): ?array
    {
        return $this->createQueryBuilder('s')
            ->where('s.nomService LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%')
            ->getQuery()
            ->getResult();
    }
    public function findBySearchTerm(string $searchTerm): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.nom_service LIKE :searchTerm')
            ->setParameter('searchTerm', $searchTerm . '%') // Recherche des noms commençant par le terme de recherche
            ->getQuery()
            ->getResult();
    }
//DQL Question 3
//public function SearchAuthorDQL($min,$max){
//    $em=$this->getEntityManager();
//    return $em->createQuery(
//        'select a from App\Entity\Author a WHERE
//        a.nb_books BETWEEN ?1 AND ?2')
//        ->setParameter(1,$min)
//        ->setParameter(2,$max)->getResult();
//}

//DQL Question 4
//public function DeleteService(){
//    $em=$this->getEntityManager();
//    return $em->createQuery(
//        'DELETE App\Entity\Service s WHERE s.nb_books = 0')
//    ->getResult();
//}


}
