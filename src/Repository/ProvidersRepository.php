<?php

namespace App\Repository;

use App\Entity\Providers;
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

    public function findByProviders($data, $page = 1): PaginationInterface
    {
        $req = $this->createQueryBuilder('p')
        ->innerJoin('p.promotion', 'pp')
        ->innerJoin('pp.service', 'c')
        ->innerJoin('p.users', 'u');
        
        $req->groupBy('p.id')
        ->orderBy('p.id', 'DESC')
        ;
        
        if (!empty($data)) {
            if (!empty($data['search']['name'])) {
                $name = $data['search']['name'] . '%';
                $req->andWhere('p.lastName LIKE :search')
                    ->orWhere('p.firstName LIKE :search')
                    ->setParameter('search', $name);
            }
        
            if ($data['search']['service'] !== null && !empty($data['search']['service'])) {
                $req->andWhere('c.name = :category')
                    ->setParameter('category', $data['search']['service']);
            }
            
            if ($data['search']['code'] !== null && !empty($data['search']['code'])) {
                $postaCode = $this->postalCodesRepository->findOneBy(['name' => $data['search']['code']]);
                
                $req->andWhere('u.postalCode = :postalCode')
                ->setParameter('postalCode', $postaCode->getId());
            }

            if ($data['search']['town'] !== null && !empty($data['search']['town'])) {
                $town = $this->townsRepository->findOneBy(['name' => $data['search']['town']]);
                
                $req->andWhere('u.town = :town')
                ->setParameter('town', $town->getId());
            }

            if ($data['search']['locality'] !== null && !empty($data['search']['locality'])) {
                $locality = $this->localitiesRepository->findOneBy(['name' => $data['search']['locality']]);
                
                $req->andWhere('u.locality = :locality')
                ->setParameter('locality', $locality->getId());
            }
        }

        return $this->paginatorInterface->paginate($req, $page, 8);
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
