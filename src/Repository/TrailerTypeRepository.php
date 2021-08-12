<?php

namespace App\Repository;

use App\Entity\TrailerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrailerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrailerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrailerType[]    findAll()
 * @method TrailerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrailerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrailerType::class);
    }

    // /**
    //  * @return TrailerType[] Returns an array of TrailerType objects
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
    public function findOneBySomeField($value): ?TrailerType
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
