<?php

namespace App\Repository;

use App\Entity\Especie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Especie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Especie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Especie[]    findAll()
 * @method Especie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspecieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Especie::class);
    }

    /*Consulta que devuelve el indice de la tabla según el dato del formulario*/
    public function obtenerIdTamano($especie){
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :comp')
            ->setParameter('comp', $especie)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Especie[] Returns an array of Especie objects
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
    public function findOneBySomeField($value): ?Especie
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
