<?php

namespace App\Repository;

use App\Entity\TeamAward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeamAward>
 *
 * @method TeamAward|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamAward|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamAward[]    findAll()
 * @method TeamAward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamAwardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamAward::class);
    }

    //    /**
    //     * @return TeamAward[] Returns an array of TeamAward objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TeamAward
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
