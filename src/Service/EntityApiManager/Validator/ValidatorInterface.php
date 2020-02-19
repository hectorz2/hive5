<?php
namespace App\Service\EntityApiManager\Validator;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
interface ValidatorInterface
{
    /**
     * ValidatorInterface constructor.
     * @param EntityInterface $entity
     * @param ManagerRegistry $doctrine
     */
    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine);

    /**
     * Validates the entity data received.
     * @param array $entityData Associative array with the entity data to validate
     * @param int|null $id in case of update
     * @return bool
     */
    public function validate(array $entityData, ?int $id = null) :bool;
}