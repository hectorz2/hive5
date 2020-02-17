<?php
namespace App\Service\EntityApiManager\Validator\Exception;

use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class EntityValidationFailedException extends Exception
{
    private array $errors;
    /**
     * EntityValidationFailedException constructor.
     * @param array $errors Key/Value array with key as property field and value as array of string errors.
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        $message = 'The entity validation failed with errors. Access to them by getErrors method.';
        parent::__construct($message);
    }

    /**
     * @return array
     */
    public function getErrors():array {
        return $this->errors;
    }
}