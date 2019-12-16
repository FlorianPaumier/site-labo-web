<?php

namespace App\Repository;

use App\Entity\SondageQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SondageQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SondageQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SondageQuestion[]    findAll()
 * @method SondageQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SondageQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SondageQuestion::class);
    }

    // /**
    //  * @return SondageQuestion[] Returns an array of SondageQuestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SondageQuestion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
