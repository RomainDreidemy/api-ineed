<?php

namespace App\Repository;

use App\Entity\MaladieChronique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MaladieChronique|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaladieChronique|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaladieChronique[]    findAll()
 * @method MaladieChronique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaladieChroniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaladieChronique::class);
    }

    // /**
    //  * @return MaladieChronique[] Returns an array of MaladieChronique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaladieChronique
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
