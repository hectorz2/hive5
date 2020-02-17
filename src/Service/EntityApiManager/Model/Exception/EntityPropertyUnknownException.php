<?php
namespace App\Service\EntityApiManager\Model\Exception;

use App\Service\EntityApiManager\Model\EntityProperty;
use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityPropertyUnknownException extends Exception
{
    public function __construct($property)
    {
        $message = "The property: '$property' doesn't exist in " . EntityProperty::class;
        parent::__construct($message);
    }
}