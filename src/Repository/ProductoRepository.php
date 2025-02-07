<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function save(Producto $producto)
    {
        $this->getEntityManager()->persist($producto);
    }

    public function findById($id)
    {
        return parent::findBy('id', $id);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findProductosLimitados(): array
    {
        $productos = $this->createQueryBuilder('p')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();

        shuffle($productos);

        return array_slice($productos, 0, 9);
    }

    public function findAllActivosByCategory($categoria): array
    {
        $productos = $this->createQueryBuilder('p')
            ->where('p.activo = true')
            ->andWhere('p.categoria = :categoria')
            ->setParameter('categoria', $categoria)
            ->getQuery()
            ->getResult();

        return $productos;
    }



//    public function getProductosLimitados()
//    {
//        $conn = $this->getEntityManager()->getConnection();
//
//        $query =
//            'SELECT p
//        FROM Producto p
//        WHERE p.categoria.id= 1
//        ORDER BY p.precio';
//        $result = $conn->executeQuery($query);
//
//        return $result->fetchAllAssociative();

//        $query->setFirstResult($offset);
//        $query->setMaxResults($limit);

  //  }

    //    /**
    //     * @return Producto[] Returns an array of Producto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Producto
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
