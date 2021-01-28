<?php


namespace App\Manager;

use App\Entity\Livre;
use App\Repository\LivreRepository;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class LivreManager extends BaseManager
{

    /**
     * @var LivreRepository
     */
    private $livreRepository;

    public function  __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        RequestStack $requestStack,
        SessionInterface $session,
        LoggerInterface $logger,
        SerializerInterface $serializer,

        LivreRepository  $livreRepository)
    {
        $this->livreRepository = $livreRepository;
        parent::__construct($em, $container, $requestStack, $session, $logger, $serializer);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function allLivre() {
        $maxPagination = (int)$this->getParameter('max_pagination');
        if($this->data->page == 1){
            $page = 0;
        }else {
            $page = ($this->data->page - 1) * $maxPagination ;
        }

        $result = [
            'total' => count($this->livreRepository->findAll()),
            'maxPagination' => $maxPagination,
            'livres' => $this->livreRepository->paginationLivre($page, $maxPagination)
        ];

        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateLivre() {

        $livre = $this->livreRepository->find($this->data->id);
        $action = 'edit';
        if(!$livre){
            $livre = new Livre();
            $action = 'add';
        }
        $livre->setTitlelivre($this->data->titlelivre);
        $livre->setEdition($this->data->edition);
        $livre->setTaille($this->data->taille);
        $this->save($livre);

        $result = [
            'action' => $action,
            'livre' => $this->livreRepository->transform($livre)
        ];

        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeLivre()
    {
        $livre = $this->livreRepository->find($this->data->id);
        $this->remove($livre);

        $result = [
         'id' => $this->data->id
        ];

        return $this->success($result);
    }


}