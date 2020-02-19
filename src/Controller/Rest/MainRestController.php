<?php

namespace App\Controller\Rest;

use App\Controller\MainController;
use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\EntityApiManagerService;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Formatter\FormatterInterface;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use App\Service\EntityApiManager\Persister\Exception\AddMethodNotExistException;
use App\Service\EntityApiManager\Persister\Exception\SetterMethodNotExistException;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use App\Service\MainControllerServicesManager\MainControllerServicesManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class MainRestController extends MainController
{
    protected bool $pagination;

    protected EntityApiManagerService $entityApiManagerService;

    /** @var ServiceEntityRepository */
    protected ServiceEntityRepository $repository;

    public function __construct(MainControllerServicesManager $mainControllerServicesManager, EntityApiManagerService $entityApiManagerService)
    {
        parent::__construct($mainControllerServicesManager);

        $limit = $this->request->query->get('limit');
        $this->pagination = $limit != null;

        $this->repository = $this->getRepository($this->getEntityClass());

        $this->entityApiManagerService = $entityApiManagerService;
    }

    /**
     * @return EntityInterface
     */
    abstract function getApiEntity(): EntityInterface;

    /**
     * @return JsonResponse
     */
    public function getAll() {
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
    public function getOne($id) {
        //TODO
    }

    /**
     * @throws EntityNotExistException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws AddMethodNotExistException
     * @throws SetterMethodNotExistException
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    public function post(): JsonResponse {
        try {
            $entities = $this->entityApiManagerService->post($this->getApiEntity(), $this->getRequestData());
            return $this->afterPostOrPut($entities);
        } catch (EntityValidationFailedException $ex) {
            $errors = $ex->getValidationErrors();
            $this->throwBadRequestException($errors);
        }
    }

    /**
     * @return JsonResponse
     * @throws AddMethodNotExistException
     * @throws EntityFieldNotFoundException
     * @throws EntityNotExistException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws SetterMethodNotExistException
     */
    public function put() {
        try {
            $entities = $this->entityApiManagerService->put($this->getApiEntity(), $this->getRequestData());
            return $this->afterPostOrPut($entities);
        } catch (EntityValidationFailedException $ex) {
            $errors = $ex->getValidationErrors();
            $this->throwBadRequestException($errors);
        }
    }

    public function delete() {
        //TODO
    }

    /**
     * @param array $entities
     * @return JsonResponse
     */
    protected function afterPostOrPut(array $entities) {
        $entityFormatterClass = $this->getApiEntity()->getFormatterClass();
        /** @var FormatterInterface $entityFormatter */
        $entityFormatter = new $entityFormatterClass($this->getApiEntity(), $this->doctrine);
        $formattedEntities = [];
        foreach ($entities as $entity) {
            $formattedEntities[] = $entityFormatter->formatFromEntity($entity);
        }

        return $this->json($formattedEntities);
    }

    /**
     * @return array
     */
    private function getRequestData(): array {
        return $this->request->request->all();
    }

    public function throwBadRequestException(array $errors)
    {
        throw new BadRequestHttpException(json_encode($errors));
    }
}