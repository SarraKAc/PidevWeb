<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;

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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
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

    public function calculerPromo()
    {
        $connection = $this->entityManager->getConnection();
        $sql = "SELECT s.id_service, " .
            "s.prix, " .
            "SUM(a.nbr_etoile) / COUNT(*) as avg_rating_per_service, " .
            "s.PrixSolde " .
            "FROM service s " .
            "JOIN avis a ON s.id_service = a.id_service " .
            "GROUP BY s.id_service, s.prix, s.PrixSolde";

        try {
            $statement = $connection->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll();

            foreach ($results as $result) {
                $id = $result['id_service'];
                $prix = $result['prix'];
                $rating = $result['avg_rating_per_service'];

                if ($rating < 5) {
                    if ($rating > 0 && $rating <= 2) {
                        // Réduction de 30%
                        $prixReduit = $prix * (1 - 0.3);
                    } elseif ($rating > 2 && $rating <= 3) {
                        // Réduction de 25%
                        $prixReduit = $prix * (1 - 0.25);
                    } elseif ($rating > 3 && $rating <= 4) {
                        // Réduction de 20%
                        $prixReduit = $prix * (1 - 0.2);
                    }
                    $this->updatePrixSolde($id, $prixReduit);
                } else {
                    // Supprimer la promotion
                    $this->updatePrixSolde($id, null);
                }
            }
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }

    private function updatePrixSolde($id, $prixReduit)
    {
        $connection = $this->entityManager->getConnection();
        $req = "UPDATE service SET PrixSolde = :prixReduit WHERE id_service = :id";

        try {
            $statement = $connection->prepare($req);
            $statement->bindValue('prixReduit', $prixReduit);
            $statement->bindValue('id', $id);
            $statement->execute();
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
    public function desactivePromo(Connection $connection) {
        $sqlDropColumn = "ALTER TABLE service DROP COLUMN PrixSolde;";
        $sqlAddColumn = "ALTER TABLE service ADD COLUMN PrixSolde FLOAT NULL;";
        try {
            $connection->executeUpdate($sqlDropColumn);
            $connection->executeUpdate($sqlAddColumn);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
