<?php

namespace App\Repository;

use App\Entity\PostCommunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostCommunity>
 *
 * @method PostCommunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostCommunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostCommunity[]    findAll()
 * @method PostCommunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCommunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostCommunity::class);
    }

//    /**
//     * @return PostCommunity[] Returns an array of PostCommunity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostCommunity
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
