<?php

namespace App\Repository;

use App\Entity\Vacuna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vacuna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacuna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacuna[]    findAll()
 * @method Vacuna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacunaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacuna::class);
    }


    /*Función que comprueba que ya haya una vacuna por ese animal*/
    public function comprobarVacunas($p_nombre, $p_ficha){
        return $this->createQueryBuilder('v')
        ->select('count(v.id)')
        ->andWhere('v.nombreV = :nombre')
        ->andWhere('v.ficha = :ficha')
        ->setParameter('nombre', $p_nombre)
        ->setParameter('ficha', $p_ficha)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }




    // /**
    //  * @return Vacuna[] Returns an array of Vacuna objects
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
    public function findOneBySomeField($value): ?Vacuna
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
