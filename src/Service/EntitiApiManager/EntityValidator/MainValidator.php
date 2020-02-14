<?php
namespace App\Service\EntitiApiManager\EntityValidator;

use App\Service\EntitiApiManager\EntityValidator\Exception\EntityFieldNotFoundException;
use App\Service\EntitiApiManager\EntityValidator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntitiApiManager\EntityValidator\Model\EntityProperty;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
abstract class MainValidator implements EntityValidatorInterface
{
    /**
     * @return string
     */
    abstract function getEntityClass(): string;

    /**
     * Key/Value array with property name as key.
     * @return EntityProperty[]
     */
    abstract function getEntityProperties(): array;

    /**
     * @param array $entityData
     * @return bool
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    public function validate(array $entityData): bool
    {
        $this->validateEntityProperties();
        $this->validateKeysExists($entityData);

        foreach ($entityData as $field => $value) {
            $this->validateEntityField($field, $value);
        }

        return true;
    }

    /**
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    private function validateEntityProperties() {
        $properties = $this->getEntityProperties();
        foreach ($properties as $field => $property) {
            if($field != $property->fieldName) {
                throw new EntityPropertyKeyNotEqualThanPropertyFieldNameException($field, $property->fieldName);
            }
        }
    }

    /**
     * @param array $entityData
     * @throws EntityFieldNotFoundException
     */
    private function validateKeysExists(array $entityData) {
        $entityProperties = $this->getEntityProperties();
        $entityDataKeys = array_keys($entityData);
        foreach ($entityProperties as $field => $property) {
            if(!in_array($property->fieldName, $entityDataKeys) || !in_array($field, $entityDataKeys)) {
                throw new EntityFieldNotFoundException($property->fieldName, $entityDataKeys);
            }
        }
    }

    /**
     * @param string $field
     * @param mixed $value
     */
    private function validateEntityField(string $field, $value) {
        $propertyField = $this->getEntityProperties()[$field];
        switch ($propertyField->type) {
            //TODO
        }
    }
}