<?php

namespace App\Repository;

use App\Entity\Activiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Activiter>
 *
 * @method Activiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activiter[]    findAll()
 * @method Activiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activiter::class);
    }

    //    /**
    //     * @return Activiter[] Returns an array of Activiter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Activiter
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
