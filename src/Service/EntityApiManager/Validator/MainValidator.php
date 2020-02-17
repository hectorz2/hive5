<?php
namespace App\Service\EntityApiManager\Validator;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
abstract class MainValidator implements ValidatorInterface
{
    protected EntityInterface $entity;

    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param array $entityData
     * @return bool
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws EntityValidationFailedException
     */
    public function validate(array $entityData): bool
    {
        $this->validateEntityProperties();
        $this->validateKeysExists($entityData);

        $errors = [];
        foreach ($entityData as $field => $value) {
            $return = $this->validateEntityField($field, $value);
            if(!$return['status']) {
                $errors[$field] = $return['errors'];
            }
        }

        if(sizeof($errors) === 0) {
            return true;
        } else {
            throw new EntityValidationFailedException($errors);
        }
    }

    /**
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     */
    private function validateEntityProperties() {
        $properties = $this->entity->getEntityProperties();
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
        $entityProperties = $this->entity->getEntityProperties();
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
     * @return array Key/Value array with 2 keys. status: true|false. Is is or not validated. errors: array. String array of the errors found.
     * @throws EntityPropertyTypeNotSupportedException
     */
    private function validateEntityField(string $field, $value) {
        $ok = true;
        $errors = [];
        $propertyField = $this->entity->getEntityProperties()[$field];
        switch ($propertyField->type) {
            //TODO the validations
            case EntityProperty::TYPE_STRING:
                break;
            case EntityProperty::TYPE_INT:
                break;
            case EntityProperty::TYPE_BOOL:
                break;
            case EntityProperty::TYPE_ENTITY:
                break;
            case EntityProperty::TYPE_ARRAY:
                break;
            case EntityProperty::TYPE_DATETIME:
                break;
            case EntityProperty::TYPE_COLLECTION:
                break;
            case EntityProperty::TYPE_FILE:
                break;
            default:
                throw new EntityPropertyTypeNotSupportedException($propertyField->type);
        }

        return [
            'status' => $ok,
            'errors' => $errors
        ];
    }
}