<?php
namespace App\Service\EntityApiManager\Validator\Exception;

use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityPropertyKeyNotEqualThanPropertyFieldNameException extends Exception
{
    /**
     * EntityFieldNotFoundException constructor.
     * @param string $propertyKey
     * @param string $propertyFieldName
     */
    public function __construct(string $propertyKey, string $propertyFieldName)
    {
        $message = "The key of the property array: '$propertyKey' and the field name: '$propertyFieldName' are not equals";
        parent::__construct($message);
    }
}