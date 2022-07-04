<?php

namespace App\Repository;

use App\Entity\UTilistauer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UTilistauer|null find($id, $lockMode = null, $lockVersion = null)
 * @method UTilistauer|null findOneBy(array $criteria, array $orderBy = null)
 * @method UTilistauer[]    findAll()
 * @method UTilistauer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UTilistauerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UTilistauer::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UTilistauer $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(UTilistauer $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UTilistauer[] Returns an array of UTilistauer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UTilistauer
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
