<?php

namespace App\Service\EntityApiManager\Persister;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Persister\Exception\AddMethodNotExistException;
use App\Service\EntityApiManager\Persister\Exception\SetterMethodNotExistException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class MainPersister implements PersisterInterface
{

    protected EntityInterface $entity;
    protected ManagerRegistry $doctrine;

    /**
     * @inheritDoc
     */
    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine)
    {
        $this->entity = $entity;
        $this->doctrine = $doctrine;
    }

    /**
     * @inheritDoc
     */
    public function persist(array $formattedData, ?int $id = null): object
    {
        $entity = $this->initializeEntity($id);

        $collections = [];
        foreach ($formattedData as $field => $value) {
            $entityProperty = $this->entity->getEntityProperties()[$field];

            if($entityProperty->type === EntityProperty::TYPE_COLLECTION) {
                $collections[$field] = $value;
            } else {
                $this->executeSetter($entity, $entityProperty, $value);
            }
        }

        $this->doctrine->getManager()->persist($entity);
        $this->doctrine->getManager()->flush();

        foreach ($collections as $field => $value) {
            $entityProperty = $this->entity->getEntityProperties()[$field];
            $this->executeAdd($entity, $entityProperty, $value);
        }

        if(sizeof($collections) > 0) {
            $this->doctrine->getManager()->flush();
        }

        return $entity;
    }

    /**
     * @param int|null $id
     * @return object
     * @throws EntityNotExistException
     */
    private function initializeEntity(?int $id): object {
        $entityClass = $this->entity->getEntityClass();

        $entity = null;
        if($id == null) {
            $entity = new $entityClass();
        } else {
            $entity = $this->entity->getRepository()->find($id);
            if($entity == null) {
                throw new EntityNotExistException($id, $entityClass);
            }
        }

        return $entity;
    }

    /**
     * @param object $entity
     * @param EntityProperty $entityProperty
     * @param mixed $value
     * @throws SetterMethodNotExistException
     */
    private function executeSetter(object &$entity, EntityProperty $entityProperty, $value) {
        $field = $entityProperty->fieldName;
        $entityClass = $this->entity->getEntityClass();

        if($entityProperty->setterMethod == null) {
            $method = 'set' . ucfirst($field);
        } else {
            $method = $entityProperty->setterMethod;
        }

        if(!method_exists($entity, $method)) {
            throw new SetterMethodNotExistException($method, $entityClass);
        }

        $entity->{$method}($value);
    }

    /**
     * @param object $entity
     * @param EntityProperty $entityProperty
     * @param mixed $value
     * @throws AddMethodNotExistException
     */
    private function executeAdd(object &$entity, EntityProperty $entityProperty, $value) {
        $entityClass = $this->entity->getEntityClass();
        $method = $entityProperty->addMethod;

        if(!method_exists($entity, $method)) {
            throw new AddMethodNotExistException($method, $entityClass);
        }

        $entity->{$method}($value);
    }
}