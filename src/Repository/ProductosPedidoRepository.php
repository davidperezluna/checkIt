<?php

namespace App\Repository;

use App\Entity\ProductosPedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductosPedido|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductosPedido|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductosPedido[]    findAll()
 * @method ProductosPedido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosPedidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductosPedido::class);
    }

    // /**
    //  * @return ProductosPedido[] Returns an array of ProductosPedido objects
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
    public function findOneBySomeField($value): ?ProductosPedido
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
