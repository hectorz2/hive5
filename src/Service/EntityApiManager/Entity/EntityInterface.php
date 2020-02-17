<?php

namespace App\Service\EntityApiManager\Entity;

use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Validator\ValidatorInterface;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
interface EntityInterface
{
    /**
     * @return string
     */
    public function getEntityClass(): string;

    /**
     * @return EntityProperty[]
     */
    public function getEntityProperties(): array;

    /**
     * @return string
     */
    public function getValidatorClass(): string;
}