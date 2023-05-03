<?php

namespace App\Repository;

use App\Entity\Providers;
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
    ) {
        parent::__construct($registry, Providers::class);
    }

    public function findByProviders($data, $page = 1): PaginationInterface
    {
        $req = $this->createQueryBuilder('p')
        ->innerJoin('p.promotion', 'pp')
        ->innerJoin('pp.service', 'c');
        
        $req->groupBy('p.id')
        ->orderBy('p.id', 'DESC')
        ;
        
        // dd($data);:
        if (!empty($data)) {
            // dd('ici');
            if (!empty($data['search']['nom'])) {
                $nom = $data['search']['nom'] . '%';
                $req->andWhere('p.nom LIKE :search')
                    ->orWhere('p.prenom LIKE :search')
                    ->setParameter('search', $nom);
            }
        
            if ($data['search']['categorie'] !== null && !empty($data['search']['categorie'])) {
                $req->andWhere('c.nom = :category')
                    ->setParameter('category', $data['search']['categorie']);
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
