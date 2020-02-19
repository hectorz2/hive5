<?php
namespace App\Service\EntityApiManager\Model\Exception;

use App\Service\EntityApiManager\Model\EntityProperty;
use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class EntityPropertyMissingException extends Exception
{
    public function __construct(string $property, int $type = null)
    {
        $message = "The property: '$property' is mandatory" . ($type == null ? '' : " for type '$type' ") .
            ' in ' . EntityProperty::class;
        parent::__construct($message);
    }
}