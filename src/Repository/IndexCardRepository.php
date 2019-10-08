<?php

namespace App\Repository;

use App\Entity\IndexCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IndexCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndexCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndexCard[]    findAll()
 * @method IndexCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IndexCard::class);
    }

    // /**
    //  * @return IndexCard[] Returns an array of IndexCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndexCard
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
