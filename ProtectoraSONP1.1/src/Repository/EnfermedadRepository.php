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

    /*Función encargada de realizar una consulta a la base de datos. Contiene como 
    parámetros el nombre de la enfermedad que se vaya a introducir y el identificador
    de la ficha para realizar el filtro por ficha de animal, devolverá 0 si el nombre
    no existe en la tabla, filtrando por animal y devolverá 1 si el dato exíste. En el caso
    de devolver 1, la inserción en la tabla no se realizará.*/
    public function comprobarEnfermedades($p_nombre, $p_ficha){
        return $this->createQueryBuilder('e')
        ->select('count(e.id)')
        ->andWhere('e.nombreE = :nombre')
        ->andWhere('e.ficha = :ficha')
        ->setParameter('nombre', $p_nombre)
        ->setParameter('ficha', $p_ficha)
        ->getQuery()
        ->getOneOrNullResult()
        ;
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
