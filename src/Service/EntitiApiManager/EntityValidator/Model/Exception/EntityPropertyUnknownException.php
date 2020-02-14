<?php
namespace App\Service\EntitiApiManager\EntityValidator\Model\Exception;

use App\Service\EntitiApiManager\EntityValidator\Model\EntityProperty;
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