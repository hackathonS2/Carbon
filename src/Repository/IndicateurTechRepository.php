<?php

namespace App\Repository;

use App\Entity\IndicateurTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IndicateurTech>
 *
 * @method IndicateurTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndicateurTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndicateurTech[]    findAll()
 * @method IndicateurTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndicateurTechRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndicateurTech::class);
    }

    public function save(IndicateurTech $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IndicateurTech $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IndicateurTech[] Returns an array of IndicateurTech objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IndicateurTech
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
