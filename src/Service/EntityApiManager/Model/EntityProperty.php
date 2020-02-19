<?php

namespace App\Service\EntityApiManager\Model;


use App\Service\EntityApiManager\Model\Exception\EntityPropertyMissingException;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyUnknownException;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityProperty
{
    const TYPE_STRING = 1;
    const TYPE_INT = 2;
    const TYPE_BOOL = 3;
    const TYPE_ENTITY = 4;
    const TYPE_DATETIME = 5;
    const TYPE_COLLECTION = 6;
    const TYPE_FILE = 7;

    /* region MANDATORY */
    public string $fieldName;
    public int $type;
    public bool $required;
    /* endregion */

    /* region METHODS */
    public ?string $getterMethod = null;
    public ?string $setterMethod = null;
    //Mandatory in type COLLECTION
    public ?string $addMethod = null;
    /* endregion */

    /* region RELATION */
    //Mandatory in type ENTITY and COLLECTION
    public ?string $targetEntityClass = null;
    /* endregion */

    /* region VALIDATION */
    public ?int $min = null;
    public ?int $max = null;
    public ?bool $unique = null;
    public ?array $constraints = null;
    /* endregion */

    /* region FORMATTING */
    public ?bool $hash = null;
    //This is to ignore the field when formatting FROM the entity.
    public ?bool  $ignoreOnGet = null;
    /* endregion */

    private function __construct(){}

    /**
     * @param array $data
     * @return EntityProperty
     * @throws EntityPropertyUnknownException
     * @throws EntityPropertyMissingException
     */
    public static function createEntityProperty(array $data): EntityProperty {
        $entityProperty = new EntityProperty();
        foreach ($data as $property => $value) {
            if(property_exists($entityProperty, $property)) {
                $entityProperty->{$property} = $value;
            } else {
                throw new EntityPropertyUnknownException($property);
            }
        }

        self::validateEntityProperty($entityProperty);

        return $entityProperty;
    }

    /**
     * @param EntityProperty $entityProperty
     * @return bool
     * @throws EntityPropertyMissingException
     */
    private static function validateEntityProperty(EntityProperty $entityProperty): bool {
        $requiredFields = [
            'fieldName',
            'type',
            'required'
        ];
        foreach ($requiredFields as $requiredField) {
            if($entityProperty->{$requiredField} === null) {
                throw new EntityPropertyMissingException($requiredField);
            }
        }

        $typesWithTargetEntityRequired = [
            self::TYPE_ENTITY,
            self::TYPE_COLLECTION
        ];
        if(in_array($entityProperty->type, $typesWithTargetEntityRequired) && $entityProperty->targetEntityClass == null) {
            throw new EntityPropertyMissingException('targetEntity', $entityProperty->type);
        }

        if($entityProperty->type === self::TYPE_COLLECTION && $entityProperty->addMethod == null) {
            throw new EntityPropertyMissingException('addMethod', $entityProperty->type);
        }

        return true;
    }
}