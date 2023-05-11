<?php

namespace App\Repository;

use App\Entity\Providers;
use Doctrine\ORM\QueryBuilder;
use App\Repository\PostalCodesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Providers>
 *
 * @method Providers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Providers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Providers[]    findAll()
 * @method Providers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvidersRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private PaginatorInterface $paginatorInterface,
        private PostalCodesRepository $postalCodesRepository,
        private TownsRepository $townsRepository,
        private LocalitiesRepository $localitiesRepository
    ) {
        parent::__construct($registry, Providers::class);
    }

    public function findByProviders($data, $page = 1, $alphabeticalOrder = false): PaginationInterface
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->innerJoin('p.promotion', 'pp')
            ->innerJoin('pp.service', 'c')
            ->innerJoin('p.users', 'u')
            ->groupBy('p.id');
    
        if ($alphabeticalOrder) {
            $queryBuilder->orderBy('p.lastName', 'ASC')
                ->addOrderBy('p.firstName', 'ASC');
        } else {
            $queryBuilder->orderBy('p.id', 'DESC');
        }
    
        if ($this->hasFilters($data)) {
            $this->applyFilters($queryBuilder, $data);
        } else {
            // If no filters are provided, return all providers
            $queryBuilder->andWhere('1=1');
        }
    
        return $this->paginatorInterface->paginate($queryBuilder, $page, 8);
    }
    

    private function hasFilters(array $data): bool
    {
        if (!isset($data['search'])) {
            return false;
        }

        foreach ($data['search'] as $value) {
            if (!empty($value)) {
                return true;
            }
        }

        return false;
    }

    
    private function applyFilters(QueryBuilder $queryBuilder, array $data): void
    {
        $expr = $queryBuilder->expr();

        if (isset($data['search']['name']) && !empty($data['search']['name'])) {
            $nameParts = explode(' ', rtrim($data['search']['name']));
            $nameConditions = [];
            $nameParameters = [];

            foreach ($nameParts as $index => $namePart) {
                $namePart = $namePart . '%';
                $nameConditions[] = $expr->orX(
                    $expr->like('p.lastName', ':search' . $index),
                    $expr->like('p.firstName', ':search' . $index)
                );
                $nameParameters['search' . $index] = $namePart;
            }

            $queryBuilder->andWhere(call_user_func_array([$expr, 'andX'], $nameConditions));

            foreach ($nameParameters as $key => $value) {
                $queryBuilder->setParameter($key, $value);
            }
        }
    
        if (isset($data['search']['service']) && !empty($data['search']['service'])) {
            $queryBuilder->andWhere('c.name = :category')
                ->setParameter('category', $data['search']['service']);
        }
    
        if (isset($data['search']['code']) && !empty($data['search']['code'])) {
            $postalCode = $this->postalCodesRepository->findOneBy(['name' => $data['search']['code']]);
            $queryBuilder->andWhere('u.postalCode = :postalCode')
                ->setParameter('postalCode', $postalCode->getId());
        }
    
        if (isset($data['search']['town']) && !empty($data['search']['town'])) {
            $town = $this->townsRepository->findOneBy(['name' => $data['search']['town']]);
            $queryBuilder->andWhere('u.town = :town')
                ->setParameter('town', $town->getId());
        }
    
        if (isset($data['search']['locality']) && !empty($data['search']['locality'])) {
            $locality = $this->localitiesRepository->findOneBy(['name' => $data['search']['locality']]);
            $queryBuilder->andWhere('u.locality = :locality')
                ->setParameter('locality', $locality->getId());
        }
    
        if (is_string($data)) {
            $queryBuilder->andWhere('c.name = :category')
                ->setParameter('category', $data);
        }
    }
    

    public function save(Providers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Providers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Providers[] Returns an array of Providers objects
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

//    public function findOneBySomeField($value): ?Providers
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
