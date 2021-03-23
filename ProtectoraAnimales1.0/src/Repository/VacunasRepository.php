<?php

namespace App\Repository;

use App\Entity\Vacunas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vacunas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacunas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacunas[]    findAll()
 * @method Vacunas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacunasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacunas::class);
    }

    // /**
    //  * @return Vacunas[] Returns an array of Vacunas objects
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
    public function findOneBySomeField($value): ?Vacunas
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
