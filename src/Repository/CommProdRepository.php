<?php

namespace App\Repository;

use App\Entity\CommProd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommProd>
 *
 * @method CommProd|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommProd|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommProd[]    findAll()
 * @method CommProd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommProdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommProd::class);
    }

//    /**
//     * @return CommProd[] Returns an array of CommProd objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CommProd
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
