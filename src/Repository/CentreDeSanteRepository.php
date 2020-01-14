<?php

namespace App\Repository;

use App\Entity\CentreDeSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CentreDeSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method CentreDeSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method CentreDeSante[]    findAll()
 * @method CentreDeSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentreDeSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CentreDeSante::class);
    }

    // /**
    //  * @return CentreDeSante[] Returns an array of CentreDeSante objects
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
    public function findOneBySomeField($value): ?CentreDeSante
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
