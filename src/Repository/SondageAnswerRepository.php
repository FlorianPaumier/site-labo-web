<?php

namespace App\Repository;

use App\Entity\Association;
use App\Entity\SondageAnswer;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SondageAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method SondageAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method SondageAnswer[]    findAll()
 * @method SondageAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SondageAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SondageAnswer::class);
    }

    public function findByuser(User $user = null)
    {
        $result = [];
        if(!is_null($user)){
            $entity = $this->createQueryBuilder("sa")
                ->select("sa.id")
                ->where('sa.user = :user')
                ->setParameter("user",$user)
                ->getQuery()
                ->getResult();

            $result = array_map(function ($id){
                return $id["id"];
            }, $entity);
        }

        return $result;
    }

    public function findCount()
    {
        return $this->createQueryBuilder("sa")
            ->innerJoin("sa.sondage", "s")
            ->distinct()
            ->select("count('s.sondage.id')")
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return SondageAnswer[] Returns an array of SondageAnswer objects
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
    public function findOneBySomeField($value): ?SondageAnswer
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
