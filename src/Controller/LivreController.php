<?php

namespace App\Controller;

use App\Manager\LivreManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class LivreController extends AbstractController
{
    /**
     * @var LivreManager
     */
    private $livreManager;

    public function __construct(LivreManager $livreManager)
    {
        $this->livreManager = $livreManager;
    }

    /**
     * @Route("/api/livre/all", name="all_livre", methods={"POST"})
     */
    public function allLivre(){
        return $this->livreManager->allLivre();
    }

    /**
     * @Route("/api/livre/update", name="update_livre", methods={"POST"})
     */
    public function updateLivre() {
        return $this->livreManager->updateLivre();
    }

    /**
     * @Route("/api/livre/remove", name="remove_livre", methods={"POST"})
     */
    public function removeLivre() {
        return $this->livreManager->removeLivre();
    }

}
