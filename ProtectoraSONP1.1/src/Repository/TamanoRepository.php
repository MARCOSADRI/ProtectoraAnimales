<?php

namespace App\Repository;

use App\Entity\Tamano;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Migrations\Query\Query;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /*Consulta que devuelve el indice de la tabla según el dato del formulario*/
    /* public function obtenerIdTamano2(EntityManagerInterface $em, $tamano)
    {
        $sql = "SELECT id FROM App\Entity\Tamano
                WHERE id = $tamano";
        $statement = $em->getConnection()->prepare($sql);
        $statement->executeQuery();
        $result = $statement->fetchAll();
        return $result;
    } */

    public function obtenerIdTamano2($tam){
        $sql = 'SELECT t.id 
                FROM App\Entity\Tamano t
                WHERE t.id = '.$tam.'';
        $em = $this->getEntityManager();
        $query = $em->createQuery($sql);
        $consulta = $query->getOneOrNullResult();
        return $consulta;
    }







    /*Consulta que devuelve el indice de la tabla según el dato del formulario*/
    public function obtenerIdTamano($tamano){
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :comp')
            ->setParameter('comp', $tamano)
            ->getQuery()
            ->getResult()
        ;
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
