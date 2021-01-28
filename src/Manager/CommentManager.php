<?php


namespace App\Manager;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\ArticleRepository;


use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CommentManager extends BaseManager
{

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleManager constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     * @param RequestStack $requestStack
     * @param SessionInterface $session
     * @param LoggerInterface $logger
     * @param SerializerInterface $serializer
     * @param CommentRepository $commentRepository
     * @param ArticleRepository $articleRepository
     */
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        RequestStack $requestStack,
        SessionInterface $session,
        LoggerInterface $logger,
        SerializerInterface $serializer,
        CommentRepository $commentRepository,
        ArticleRepository $articleRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
        parent::__construct($em, $container, $requestStack, $session, $logger, $serializer);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function allComment(){
        $maxPagination = (int)$this->getParameter('max_pagination');
        if($this->data->page == 1){
            $page = 0;
        }else {
            $page = ($this->data->page -1 ) * $maxPagination;
        }

        $result = [
            'total' => count($this->commentRepository->findAll()),
            'maxPagination' => $maxPagination,
            'comments' => $this->commentRepository->paginationComment($page, $maxPagination),
            'articles' => $this->articleRepository->transformAll($this->articleRepository->findAll())
        ];

        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateComment(){

        $comment = $this->commentRepository->find($this->data->id);
        $article = $this->articleRepository->find($this->data->article->id);
        $action = 'edit';
        if(!$comment) {
            $comment = new Comment();
            $action = 'add';
        }


        $comment->setTextcom($this->data->textcom);
        $comment->setPersocom($this->data->persocom);
        $comment->setDatecom(new \DateTime('now')); // new \Datetime();
        $comment->setArticle($article);
        $this->save($comment);


        $result = [
         'action' => $action,
            'comment' => $this->commentRepository->transform($comment)
        ];

        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeComment(){

        $comment = $this->commentRepository->find($this->data->id);
        $this->remove($comment);

        $result = [
          'id' => $this->data->id
        ];

        return $this->success($result);
    }


}