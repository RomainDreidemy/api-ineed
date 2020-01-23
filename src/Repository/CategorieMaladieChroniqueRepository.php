<?php

namespace App\Repository;

use App\Entity\CategorieMaladieChronique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieMaladieChronique|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMaladieChronique|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMaladieChronique[]    findAll()
 * @method CategorieMaladieChronique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieMaladieChroniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieMaladieChronique::class);
    }

    // /**
    //  * @return CategorieMaladieChronique[] Returns an array of CategorieMaladieChronique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieMaladieChronique
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
