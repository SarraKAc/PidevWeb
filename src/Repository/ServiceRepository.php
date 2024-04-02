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
