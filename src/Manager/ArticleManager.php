<?php


namespace App\Manager;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;

use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ArticleManager extends BaseManager
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * ArticleManager constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     * @param RequestStack $requestStack
     * @param SessionInterface $session
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     * @param ArticleRepository $articleRepository
     * @param AuthorRepository $authorRepository
     * @param CommentRepository $commentRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        RequestStack $requestStack,
        SessionInterface $session,
        LoggerInterface $logger,
        SerializerInterface $serializer,

        ArticleRepository $articleRepository,
        AuthorRepository $authorRepository,
        CommentRepository $commentRepository,
        CategoryRepository $categoryRepository)

    {
        $this->articleRepository = $articleRepository;
        $this->authorRepository = $authorRepository;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;

        //

        parent::__construct($em, $container, $requestStack, $session, $logger, $serializer);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function allArticle()
    {
        $maxPagination = (int)$this->getParameter('max_pagination');
        if($this->data->page == 1){
            $page = 0;
        }else {
            $page = ($this->data->page - 1) * $maxPagination ;
        }

        $result = [
            'total' => count($this->articleRepository->findAll()),
            'maxPagination' => $maxPagination,
            'articles' => $this->articleRepository->paginationArticle($page,$maxPagination),
            'authors'  => $this->authorRepository->transformAll($this->authorRepository->findAll()),
//            'comments' => $this->commentRepository->transformAll($this->commentRepository->findAll())
            //
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateArticle()
    {
        $article = $this->articleRepository->find($this->data->id);
        $author = $this->authorRepository->find($this->data->author->id);
        $category = $this->categoryRepository->find($this->data->category->id);
        $action = 'edit';
        if(!$article){
            $article = new Article();
            $action = 'add';
        }
        $article->setTitle($this->data->title);
        $article->setAuthor($author);
        $article->setDescription($this->data->description);
        $article->setCategory($category);
        $this->save($article);

        $result = [
            'action' => $action,
            'article' => $this->articleRepository->transform($article)
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeArticle()
    {
        $article = $this->articleRepository->find($this->data->id);
        $this->remove($article);

        $result = [
            'id' => $this->data->id
        ];
        return $this->success($result);
    }
}