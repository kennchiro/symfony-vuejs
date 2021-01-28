<?php

namespace App\Controller;

use App\Manager\CarManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @var CarManager
     */
    private $carManager;

    public function __construct(CarManager $carManager)
    {
        $this->carManager = $carManager;
    }

    /**
     * @Route("/api/car/all", name="all_car", methods={"POST"})
     */
    public function allCar()
    {
        return $this->carManager->allCar();
    }

    /**
     * @Route("/api/car/update", name="update_car", methods={"POST"})
     */
    public function updateCar()
    {
        return $this->carManager->updateCar();
    }

    /**
     * @Route("/api/car/remove", name="remove_car", methods={"POST"})
     */
    public function removeCar()
    {
        return $this->carManager->removeCar();
    }
}
