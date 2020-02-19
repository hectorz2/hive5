<?php
namespace App\Service\EntityApiManager\Persister\Exception;

use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class SetterMethodNotExistException extends Exception
{
    public function __construct(string $method, string $entityClass)
    {
        $message = "The method '$method' doesn't exist in class '$entityClass'";
        parent::__construct($message);
    }
}