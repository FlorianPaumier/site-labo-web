<?php

namespace App\Repository;

use App\Entity\Sondage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sondage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sondage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sondage[]    findAll()
 * @method Sondage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SondageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sondage::class);
    }

    // /**
    //  * @return Sondage[] Returns an array of Sondage objects
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
    public function findOneBySomeField($value): ?Sondage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAnswerableByAssociations($user, $associations = null)
    {
        if(is_null($associations)){
            return [];
        }

        return $this->createQueryBuilder("s")
            ->innerJoin("s.association", "a")
            ->innerJoin("s.sondageAnswers", "sa")
            ->where("a.id = :id")
            ->andWhere("sa.user != :user")
            ->andWhere("s.enable = true")
            ->setParameter("id", $associations)
            ->setParameter("user", $user)
            ->getQuery()
            ->getResult();
    }
    public function findAnsweredByAssociations($user, $associations = null)
    {
        if(is_null($associations)){
            return [];
        }

        return $this->createQueryBuilder("s")
            ->innerJoin("s.association", "a")
            ->innerJoin("s.sondageAnswers", "sa")
            ->where("a.id = :id")
            ->andWhere("sa.user = :user")
            ->andWhere("s.enable = true")
            ->setParameter("id", $associations)
            ->setParameter("user", $user)
            ->getQuery()
            ->getResult();
    }
}
