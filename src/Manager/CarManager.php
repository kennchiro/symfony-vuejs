<?php


namespace App\Manager;


use App\Entity\Car;
use App\Repository\CarRepository;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CarManager extends BaseManager
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $container,
        RequestStack $requestStack,
        SessionInterface $session,
        LoggerInterface $logger,
        SerializerInterface $serializer,

        CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
        parent::__construct($em, $container, $requestStack, $session, $logger, $serializer);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function allCar()
    {
        $maxPagination = (int)$this->getParameter('max_pagination');
        if($this->data->page == 1){
            $page = 0;
        }else {
            $page = ($this->data->page - 1) * $maxPagination ;
        }

        $result = [
            'total' => count($this->carRepository->findAll()),
            'maxPagination' => $maxPagination,
            'cars' => $this->carRepository->paginationCar($page,$maxPagination)
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateCar()
    {
        $car = $this->carRepository->find($this->data->id);
        $action = 'edit';
        if(!$car){
            $car = new Car();
            $action = 'add';
        }
        $car->setName($this->data->name);
        $car->setType($this->data->type);
        $this->save($car);

        $result = [
            'action' => $action,
            'car' => $this->carRepository->transform($car)
        ];
        return $this->success($result);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeCar()
    {
        $car = $this->carRepository->find($this->data->id);
        $this->remove($car);

        $result = [
            'id' => $this->data->id
        ];
        return $this->success($result);
    }
}