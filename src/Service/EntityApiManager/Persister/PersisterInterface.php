<?php

namespace App\Service\EntityApiManager\Persister;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Persister\Exception\AddMethodNotExistException;
use App\Service\EntityApiManager\Persister\Exception\SetterMethodNotExistException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
interface PersisterInterface
{
    /**
     * PersisterInterface constructor.
     * @param EntityInterface $entity
     * @param ManagerRegistry $doctrine
     */
    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine);

    /**
     * Persists the data from the Formatter into database and return the Entity.
     * @param array $formattedData
     * @param int|null $id the entity id to persist in case it is update.
     * @return object
     * @throws EntityNotExistException
     * @throws SetterMethodNotExistException
     * @throws AddMethodNotExistException
     */
    public function persist(array $formattedData, ?int $id = null): object;
}