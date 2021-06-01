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


    /*Función encargada de realizar una consulta a la base de datos. Contiene como 
    parámetros el nombre de la vacuna que se vaya a introducir y el identificador
    de la ficha para realizar el filtro por ficha de animal, devolverá 0 si el nombre
    no existe en la tabla, filtrando por animal y devolverá 1 si el dato exíste. En el caso
    de devolver 1, la inserción en la tabla no se realizará.*/
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
