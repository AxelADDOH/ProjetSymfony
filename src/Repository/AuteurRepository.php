<?php

namespace App\Repository;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    /**
     * @return Auteur[]
     */
    public function lastestAuteurs():array {
        return $this->createQueryBuilder('p')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $value
     * @return Livre[]
     */
    public function BookByEditeur($value):array {
        /*return $this->createQueryBuilder('p')
            ->select('r')
            ->from('App:Auteur','a')
            ->innerJoin('p.livres','la',ON )
            ->innerJoin('n.fk_editeur','e' , ON )
            ->andWhere('p.id = :val')
            ->setParameter('val',$value)
            ->getQuery()
            ->*/

           $conn = $this->getEntityManager()->getConnection();
           $ve =
               'select *
                from auteur a 
                inner join livre_auteur la on la.auteur_id = a.id
                inner join livre l on l.id = la.livre_id 
                inner join editeur e on e.id = l.fk_editeur_id
                where a.id = :value ';
           $qte = $conn->prepare($ve);
           $qte->execute(['value'=>$value]);
            return $qte->fetchAll();


        /*$em = $this->getEntityManager()->createQuery(
                'select a
                from Auteur a
                inner join  livre_auteur la on la.auteur_id = a.id
                inner join    livre l on l.id = la.livre_id 
                inner join  editeur e on e.id = l.fk_editeur_id
                where a.id = ?1');
        $em->setParameter(1,$value);
        $result=$em->getResult();
        return $result;*/
    }
    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
