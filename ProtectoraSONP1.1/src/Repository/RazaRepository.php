<?php

namespace App\Repository;

use App\Entity\Raza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Raza|null find($id, $lockMode = null, $lockVersion = null)
 * @method Raza|null findOneBy(array $criteria, array $orderBy = null)
 * @method Raza[]    findAll()
 * @method Raza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RazaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raza::class);
    }

    /*Consulta que devuelve el indice de la tabla según el dato del formulario*/
    /* public function obtenerIdTamano($raza){
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :comp')
            ->setParameter('comp', $raza)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    } */

    // /**
    //  * @return Raza[] Returns an array of Raza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Raza
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
