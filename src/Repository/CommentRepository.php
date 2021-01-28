<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
//    private $articleRepository;

    public function __construct(ManagerRegistry $registry)
    {
//        $this->articleRepository = $articleRepository;
        parent::__construct($registry, Comment::class);
    }

    public function transform(Comment $comment){
       return [
           'id' => $comment->getId(),
           'textcom' => $comment->getTextcom(),
           'persocom' => $comment->getPersocom(),
           'datecom' => $comment->getDatecom()->format('d-m-Y'),
//           'article' => $this->articleRepository->transform($comment->getArticle())
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

    public function paginationComment(int $page, int $max)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setFirstResult($page)
            ->setMaxResults($max);

        $comments = $qb ->getQuery()->getResult();
        $result = [];
        foreach($comments as $comment){
            $result[] = $this->transform($comment);
        }

        return $result;
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
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
    public function findOneBySomeField($value): ?Comment
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
