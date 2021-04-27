<?php

namespace App\Repository;

use App\Entity\Enfermedad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Enfermedad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enfermedad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enfermedad[]    findAll()
 * @method Enfermedad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnfermedadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enfermedad::class);
    }

    // /**
    //  * @return Enfermedad[] Returns an array of Enfermedad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enfermedad
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
