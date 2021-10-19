<?php

namespace App\Repository;

use App\Entity\Table1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Table1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Table1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Table1[]    findAll()
 * @method Table1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Table1Repository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Table1::class);
        $this->manager = $manager;
    }

    // /**
    //  * @return Table1[] Returns an array of Table1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
    public function transform(){
        return[
            'id'    =>$this->getId(),
            'title' =>$this->getTitle()
        ];
        
    }


    public function saveTable($id, $Title)
    {
        $newtable = new Table1();

        $newtable
            ->setId($id)
            ->setTitle($Title);

        $this->manager->persist($newtable);
        $this->manager->flush();
    }
    /*
    public function findOneBySomeField($value): ?Table1
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
