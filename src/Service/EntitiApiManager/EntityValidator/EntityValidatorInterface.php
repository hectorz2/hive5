<?php
namespace App\Service\EntitiApiManager\EntityValidator;


/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
interface EntityValidatorInterface
{
    public function getEntityClass() :string;

    /**
     * Validates the entity data received.
     * @param array $entityData Associative array with the entity data to validate
     * @return bool
     */
    public function validate(array $entityData) :bool;
}