<?php

namespace App\Repository;

use App\Entity\CashPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashPrice>
 *
 * @method CashPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashPrice[]    findAll()
 * @method CashPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashPrice::class);
    }

    //    /**
    //     * @return CashPrice[] Returns an array of CashPrice objects
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

    //    public function findOneBySomeField($value): ?CashPrice
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
