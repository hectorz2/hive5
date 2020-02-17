<?php
namespace App\Service\EntityApiManager\Exception;

use App\Service\EntityApiManager\Validator\Model\EntityProperty;
use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class EntityNotExistException extends Exception
{
    /**
     * EntityNotExistException constructor.
     * @param int $id
     * @param string $entityClass
     */
    public function __construct(int $id, string $entityClass)
    {
        $message = "The entity for class: '$entityClass' with id: '$id' doesn't exist in database.";
        parent::__construct($message);
    }
}