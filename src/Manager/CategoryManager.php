<?php

namespace App\Manager;
use App\Entity\Category;
use App\Repository\CategoryRepository;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;


class CategoryManager extends BaseManager
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        RequestStack $requestStack,
        SessionInterface $session,
        LoggerInterface $logger,
        SerializerInterface $serializer,

       CategoryRepository $categoryRepository)
    {
        $this->categoryRepository= $categoryRepository;
        parent::__construct($em, $container, $requestStack, $session, $logger, $serializer);
    }

    public function allCategory()
    {
        $maxPagination = (int)$this->getParameter('max_pagination');
        if($this->data->page == 1){
            $page = 0;
        }else {
            $page = ($this->data->page - 1) * $maxPagination ;
        }

        $result = [
            'total' => count($this->categoryRepository->findAll()),
            'maxPagination' => $maxPagination,
            'categorys' => $this->categoryRepository->paginationCategory($page,$maxPagination)
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateCategory()
    {
        $category = $this->categoryRepository->find($this->data->id);
        $action = 'edit';
        if(!$category){
            $category = new Category();
            $action = 'add';
        }
        $category->setNomcat($this->data->nomcat);
        $this->save($category);

        $result = [
            'action' => $action,
            'category' => $this->categoryRepository->transform($category)
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeCategory()
    {
        $category = $this->categoryRepository->find($this->data->id);
        $this->remove($category);

        $result = [
            'id' => $this->data->id
        ];
        return $this->success($result);
    }


}