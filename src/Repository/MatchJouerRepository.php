<?php

namespace App\Repository;

use App\Entity\MatchJouer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchJouer|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchJouer|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchJouer[]    findAll()
 * @method MatchJouer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchJouerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchJouer::class);
    }

    // /**
    //  * @return MatchJouer[] Returns an array of MatchJouer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatchJouer
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
