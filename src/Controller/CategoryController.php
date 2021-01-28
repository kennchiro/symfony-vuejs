<?php

namespace App\Controller;

use App\Manager\CategoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @var CategoryManager
     */
    private $categoryManager;

    public function __construct(CategoryManager  $categoryManager){
        $this->categoryManager = $categoryManager;
    }

    /**
     * @Route("/api/category/all", name="all_category", methods={"POST"})
     */
    public function allCategory()
    {
        return $this->categoryManager->allCategory();
    }

    /**
     * @Route("/api/category/update", name="update_category", methods={"POST"})
     */
    public function updateCategory()
    {
        return $this->categoryManager->updateCategory();
    }

    /**
     * @Route("/api/category/remove", name="remove_category", methods={"POST"})
     */
    public function removeCategory()
    {
        return $this->categoryManager->removeCategory();
    }
}
