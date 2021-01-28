<?php

namespace App\Repository;

use App\Entity\Category;
use App\Manager\ArticleManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    private $articleRepositoy;

    public function __construct(ManagerRegistry $registry, ArticleRepository $articleRepositoy)
    {
        $this->articleRepositoy = $articleRepositoy;
        parent::__construct($registry, Category::class);
    }

    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
           'id' => $category->getId(),
            'nomcat' => $category->getNomcat(),
            'article' => $this->articleRepositoy->transformAll($category->getArticle())
        ];
    }

    /**
     * @param $items
     * @return array
     */
    public function transformAll($items)
    {
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
    public function paginationCategory(int $page, int $max)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setFirstResult($page)
            ->setMaxResults($max);

        $categorys = $qb ->getQuery()->getResult();
        $result = [];
        foreach($categorys as $category){
            $result[] = $this->transform($category);
        }

        return $result;
    }
    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
