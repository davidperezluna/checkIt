<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function findByString($stringBusqueda)  
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = ' 
            SELECT *
            FROM Producto p
            WHERE p.nombre LIKE :val
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['val' => "%".$stringBusqueda."%"]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
