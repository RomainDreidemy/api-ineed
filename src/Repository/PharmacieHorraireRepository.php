<?php

namespace App\Repository;

use App\Entity\PharmacieHorraire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PharmacieHorraire|null find($id, $lockMode = null, $lockVersion = null)
 * @method PharmacieHorraire|null findOneBy(array $criteria, array $orderBy = null)
 * @method PharmacieHorraire[]    findAll()
 * @method PharmacieHorraire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PharmacieHorraireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PharmacieHorraire::class);
    }

    // /**
    //  * @return PharmacieHorraire[] Returns an array of PharmacieHorraire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PharmacieHorraire
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
