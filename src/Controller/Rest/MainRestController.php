<?php

namespace App\Controller\Rest;

use App\Controller\MainController;
use App\Service\MainControllerServicesManager\MainControllerServicesManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class MainRestController extends MainController
{
    protected bool $pagination;

    /** @var ServiceEntityRepository */
    private ServiceEntityRepository $repository;

    public function __construct(MainControllerServicesManager $mainControllerServicesManager)
    {
        parent::__construct($mainControllerServicesManager);

        $limit = $this->request->query->get('limit');
        $this->pagination = $limit != null;

        $this->repository = $this->getRepository($this->getEntityClass());
    }

    /**
     * @return string
     */
    abstract function getEntityClass();

    /**
     * @return JsonResponse
     */
    protected function getAll() {
        $qb = $this->repository->createQueryBuilder('e');
        //TODO pagination
        $entities = $qb->getQuery()->execute();
        //TODO serializer
        return $this->json($entities);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    protected function getOne($id) {
        //TODO
    }

    protected function post() {
        //TODO
    }

    protected function put() {
        //TODO
    }

    protected function delete() {
        //TODO
    }
}