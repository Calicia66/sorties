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

    public function findByEvent($value): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
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
