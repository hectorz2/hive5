<?php
namespace App\Service\EntityApiManager\Model\Exception;

use App\Service\EntityApiManager\Model\EntityProperty;
use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityPropertyTypeNotSupportedException extends Exception
{
    public function __construct($type)
    {
        $message = "The property type: '$type' is not supported for the class " . EntityProperty::class;
        parent::__construct($message);
    }
}