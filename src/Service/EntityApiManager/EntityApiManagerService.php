<?php
namespace App\Service\EntityApiManager;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;

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
    protected function getOne(int $id): object {
        //TODO
    }

    /**
     * @return object[]
     */
    protected function getAll(): array {
        //TODO
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return object[]
     */
    protected function post(EntityInterface $entity, array $data): array {
        //TODO
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @return object[]
     */
    protected function put(EntityInterface $entity, array $data): array {
        //TODO
    }

    /**
     * @param int $id
     */
    protected function delete(int $id) {
        //TODO
    }

    /**
     * @param EntityInterface $entity
     * @param array $data
     * @throws EntityNotExistException
     * @throws Model\Exception\EntityPropertyTypeNotSupportedException
     * @throws Validator\Exception\EntityFieldNotFoundException
     * @throws Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws Validator\Exception\EntityValidationFailedException
     */
    private function postOrPut(EntityInterface $entity, array $data) {
        $entityValidatorClass = $entity->getValidator();
        /** @var ValidatorInterface $entityValidator */
        $entityValidator = new $entityValidatorClass();

        $entityClass = $entity->getEntityClass();
        foreach ($data as $entityData) {
            $id = null;
            if(isset($entityData['id'])) {
                $id = intval($entityData['id']);
                $entityData = $entityData['data'];
            }

            $entityValidator->validate($entityData);

            $entity = null;
            if($id == null) {
                $entity = new $entityClass();
            } else {
                $entity = $this->doctrine->getRepository($entityClass)->find($id);
                if($entity == null) {
                    throw new EntityNotExistException($id, $entityClass);
                }
            }


        }
    }
}