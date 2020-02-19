<?php
namespace App\Service\EntityApiManager;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Formatter\FormatterInterface;
use App\Service\EntityApiManager\Persister\PersisterInterface;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use App\Service\EntityApiManager\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityApiManagerService
{
    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param int $id
     * @return object
     */
    public function getOne(int $id): object {
        //TODO
    }

    /**
     * @return object[]
     */
    public function getAll(): array {
        //TODO
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return object[]
     * @throws EntityNotExistException
     * @throws EntityValidationFailedException
     * @throws Model\Exception\EntityPropertyTypeNotSupportedException
     * @throws Persister\Exception\AddMethodNotExistException
     * @throws Persister\Exception\SetterMethodNotExistException
     * @throws Validator\Exception\EntityFieldNotFoundException
     * @throws Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    public function post(EntityInterface $entity, array $data): array {
        return $this->postOrPut($entity, $data);
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return object[]
     * @throws EntityNotExistException
     * @throws EntityValidationFailedException
     * @throws Model\Exception\EntityPropertyTypeNotSupportedException
     * @throws Persister\Exception\AddMethodNotExistException
     * @throws Persister\Exception\SetterMethodNotExistException
     * @throws Validator\Exception\EntityFieldNotFoundException
     * @throws Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    public function put(EntityInterface $entity, array $data): array {
        return $this->postOrPut($entity, $data);
    }

    /**
     * @param int $id
     */
    public function delete(int $id) {
        //TODO
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return array
     * @throws EntityNotExistException
     * @throws Model\Exception\EntityPropertyTypeNotSupportedException
     * @throws Persister\Exception\AddMethodNotExistException
     * @throws Persister\Exception\SetterMethodNotExistException
     * @throws Validator\Exception\EntityFieldNotFoundException
     * @throws Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityValidationFailedException
     */
    private function postOrPut(EntityInterface $entity, array $data): array {
        $entityValidatorClass = $entity->getValidatorClass();
        $entityFormatterClass = $entity->getFormatterClass();
        $entityPersisterClass = $entity->getPersisterClass();

        /** @var ValidatorInterface $entityValidator */
        $entityValidator = new $entityValidatorClass($entity, $this->doctrine);
        /** @var FormatterInterface $entityFormatter */
        $entityFormatter = new $entityFormatterClass($entity, $this->doctrine);
        /** @var PersisterInterface $entityPersister */
        $entityPersister = new $entityPersisterClass($entity, $this->doctrine);

        $entities = [];
        foreach ($data as $entityData) {
            $id = null;
            if(isset($entityData['id'])) {
                $id = intval($entityData['id']);
                $entityData = $entityData['data'];
            }

            $entityValidator->validate($entityData);
            $formattedEntityData = $entityFormatter->formatToEntity($entityData);
            $entity = $entityPersister->persist($formattedEntityData, $id);

            if($id == null) {
                $entities[] = $entity;
            } else {
                $entities[$id]= $entity;
            }
        }

        return $entities;
    }
}