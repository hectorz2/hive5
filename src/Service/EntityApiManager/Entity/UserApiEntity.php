<?php

namespace App\Service\EntityApiManager\Entity;

use App\Entity\User;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Validator\MainValidator;
use App\Service\EntityApiManager\Validator\ValidatorInterface;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class UserApiEntity implements EntityInterface
{
    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function getEntityProperties(): array
    {
        // TODO: Implement getEntityProperties() method.
    }

    /**
     * @inheritDoc
     */
    public function getValidator(): string
    {
        return MainValidator::class;
    }
}