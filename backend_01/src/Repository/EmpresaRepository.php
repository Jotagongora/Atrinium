<?php

namespace App\Repository;

use App\Entity\Empresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Empresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empresa[]    findAll()
 * @method Empresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    public function findAllCompanies() {
        return $this->getEntityManager()
            ->createQuery('  
                SELECT u FROM App\Entity\Empresa u')->getResult();
    }

    public function findByTerm(string $term)
    {
        $queryBuilder = $this->createQueryBuilder('e');

        $queryBuilder->where(
            $queryBuilder->expr()->orX(
                $queryBuilder->expr()->like('e.Nombre' , ':term')
            )
        )
        ->setParameter('term', '%'.$term.'%');

        return $queryBuilder->getQuery();
    }

    // /**
    //  * @return Empresa[] Returns an array of Empresa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Empresa
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
