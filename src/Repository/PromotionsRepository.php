<?php

namespace App\Repository;

use App\Entity\Promotions;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Promotions>
 *
 * @method Promotions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotions[]    findAll()
 * @method Promotions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionsRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PaginatorInterface $paginatorInterface,
    ) {
        parent::__construct($registry, Promotions::class);
    }

    public function findBycateg(int $id, int $page): PaginationInterface
    {
        $data = $this->createQueryBuilder('p')
            ->where('p.service = :id')
            ->setParameter('id', $id)
            ->orderBy('p.id', 'DESC') 
            ->getQuery()
            ->getResult()
        ;

        return $this->paginatorInterface->paginate($data, $page, 8 );
    }

    public function save(Promotions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Promotions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Promotions[] Returns an array of Promotions objects
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

//    public function findOneBySomeField($value): ?Promotions
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
