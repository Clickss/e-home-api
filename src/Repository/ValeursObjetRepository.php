<?php

namespace App\Repository;

use App\Entity\ValeursObjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ValeursObjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValeursObjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValeursObjet[]    findAll()
 * @method ValeursObjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValeursObjetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ValeursObjet::class);
    }

//    /**
//     * @return ValeursObjet[] Returns an array of ValeursObjet objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValeursObjet
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
