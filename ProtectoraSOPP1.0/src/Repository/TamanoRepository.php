<?php

namespace App\Repository;

use App\Entity\Tamano;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tamano|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tamano|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tamano[]    findAll()
 * @method Tamano[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TamanoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tamano::class);
    }

    // /**
    //  * @return Tamano[] Returns an array of Tamano objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tamano
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
