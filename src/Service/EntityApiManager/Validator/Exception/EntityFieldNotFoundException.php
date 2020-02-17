<?php
namespace App\Service\EntityApiManager\Validator\Exception;

use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityFieldNotFoundException extends Exception
{
    /**
     * EntityFieldNotFoundException constructor.
     * @param string $property
     * @param string[] $entityProperties
     */
    public function __construct(string $property, array $entityProperties)
    {
        $message = "The property: '$property' doesn't found in '" . implode(', ', $entityProperties) . "'";
        parent::__construct($message);
    }
}