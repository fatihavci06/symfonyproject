<?php

namespace App\Repository;

use App\Entity\Kategori;
use App\Entity\Urun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt\Return_;

/**
 * @extends ServiceEntityRepository<Urun>
 *
 * @method Urun|null find($id, $lockMode = null, $lockVersion = null)
 * @method Urun|null findOneBy(array $criteria, array $orderBy = null)
 * @method Urun[]    findAll()
 * @method Urun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Urun::class);
    }
    public function findAllGreaterThan(int $price)
    {
        $qb=$this->createQueryBuilder('u')
            ->andWhere('u.fiyat > :price')
            ->setParameter('price',$price)
            ->orderBy('u.fiyat','ASC')
            ->getQuery();

        return $qb->execute();
    }
    public function findByCategory(Kategori $kategori)
    {
        return $this->createQueryBuilder('u') //urunun kısaltması
            ->andWhere('u.kategori = :kategori')//entitydeki kategori relationuna baktık.
            ->setParameter('kategori', $kategori)
            ->getQuery()
            ->getResult();
    }
    /**
     * @throws ORMException 
     * @throws OptimisticLockException
     */
    public function add(Urun $entity, bool $flush = true): void
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
    public function remove(Urun $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Urun[] Returns an array of Urun objects
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
    public function findOneBySomeField($value): ?Urun
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
