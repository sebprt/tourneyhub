<?php

namespace App\Repository;

use App\Entity\CashPriceContribution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashPriceContribution>
 *
 * @method CashPriceContribution|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashPriceContribution|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashPriceContribution[]    findAll()
 * @method CashPriceContribution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashPriceContributionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashPriceContribution::class);
    }

    //    /**
    //     * @return CashPriceContribution[] Returns an array of CashPriceContribution objects
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

    //    public function findOneBySomeField($value): ?CashPriceContribution
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
