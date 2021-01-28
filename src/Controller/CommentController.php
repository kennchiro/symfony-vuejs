<?php

namespace App\Controller;

use App\Manager\CommentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CommentController extends AbstractController
{
    /**
     * @var CommentManager
     */
    private $commentManager;

    /**
     * CommentController constructor.
     * @param CommentManager $commentManager
     */
    public function __construct(CommentManager $commentManager){
        $this->commentManager = $commentManager;
    }

    /**
     * @Route("/api/comment/all", name="all_comment", methods={"POST"})
     */
    public function allComment()
    {
        return $this->commentManager->allComment();
    }

    /**
     * @Route("/api/comment/update", name="update_comment", methods={"POST"})
     */
    public function updateComment()
    {
        return $this->commentManager->updateComment();
    }

    /**
     * @Route("/api/comment/remove", name="remove_comment", methods={"POST"})
     */
    public function removeComment()
    {
        return $this->commentManager->removeComment();
    }

}

