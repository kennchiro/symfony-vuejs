<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     * @param Livre $livre
     * @return array
     */
    public function transform(Livre $livre) {

        return [
            'id' => $livre->getId(),
            'titlelivre' => $livre->getTitlelivre(),
            'edition' => $livre->getEdition(),
            'taille'=> $livre->getTaille()
        ];
    }

    /**
     * @param $items
     * @return array
     */
    public function transformAll($items){
        $result = [];
        foreach ($items as $item){
            $result[] = $this->transform($item);
        }

        return $result;
    }

    /**
     * @param int $page
     * @param int $max
     * @return array
     */
    public function paginationLivre(int $page, int $max) {
        $qb = $this->createQueryBuilder('a')
             ->orderBy('a.id','ASC')
             ->setFirstResult($page)
             ->setMaxResults($max);

        $livres = $qb->getQuery()->getResult();
        $result = [];
        foreach ($livres as $livre){
            $result[] = $this->transform($livre);
        }
        return $result;
    }


    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
