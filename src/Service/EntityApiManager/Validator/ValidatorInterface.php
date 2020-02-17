<?php
namespace App\Service\EntityApiManager\Validator;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
interface ValidatorInterface
{
    /**
     * ValidatorInterface constructor.
     * @param EntityInterface $entity
     */
    public function __construct(EntityInterface $entity);

    /**
     * Validates the entity data received.
     * @param array $entityData Associative array with the entity data to validate
     * @return bool
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws EntityValidationFailedException
     */
    public function validate(array $entityData) :bool;
}