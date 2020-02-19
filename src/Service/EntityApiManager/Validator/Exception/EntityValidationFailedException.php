<?php
namespace App\Service\EntityApiManager\Validator\Exception;

use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class EntityValidationFailedException extends Exception
{
    private array $validationErrors;
    /**
     * EntityValidationFailedException constructor.
     * @param array $errors Key/Value array with key as property field and value as array of string errors.
     */
    public function __construct(array $errors)
    {
        $this->validationErrors = $errors;
        $message = 'The entity validation failed with errors. Access to them by getValidationErrors method.';
        parent::__construct($message);
    }

    /**
     * @return array key/value array with field as key and array of errors as value.
     */
    public function getValidationErrors(): array {
        return $this->validationErrors;
    }
}