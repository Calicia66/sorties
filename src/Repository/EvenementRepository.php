<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function findByCampus(): ?Evenement
    {

        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', 'mama')
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        /* Version avec DQL*/
        /* version avec Query Builder
        $em = $this->getEntityManager();
        $dql = "SELECT s,c
        FROM App\Entity\Evenement s
        JOIN s.users c
        WHERE s.id= : 3
         ";
        $qb = $this->createQueryBuilder('s');
        $qb->select('s','c')
        ->from(Evenement::class, 's')
            ->andWhere('s.popularity >= 10')
            ->join('s.seasons', 'seas')
            ->Select('s')
            ->addSelect('c')
            ->addOrderBy('s.vote', 'DESC');
        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);*/

    }

    public function findByCampus()
    {

        $qb = $this->createQueryBuilder('e');
        $qb->andWhere('e.campus = Nantes');
        $qb->setMaxResults(20);
        $query = $qb->getQuery();
        return $query->getResult();


        /*
        $em = $this->getEntityManager();
        //Je sélectionne tous les colonnes depuis Evenement avec mon e
        $dql = "SELECT e
                FROM App\Entity\Evenement e
                WHERE e.campus = Nantes";
        $query = $em->createQuery($dql);
        $query->setMaxResults(20);
        return $query->getResult();
        */
    }




    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
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

}
