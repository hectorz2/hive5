<?php

namespace App\Service\EntityApiManager\Model;


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
    const TYPE_ARRAY = 5;
    const TYPE_DATETIME = 6;
    const TYPE_COLLECTION = 7;
    const TYPE_FILE = 8;

    public string $fieldName;
    public int $type;
    public bool $required;

    private function __construct()
    {
    }

    /**
     * @param array $data
     * @return EntityProperty
     * @throws EntityPropertyUnknownException
     */
    public function createEntityProperty(array $data):EntityProperty {
        $entityProperty = new $this();
        foreach ($data as $property => $value) {
            if(property_exists($this, $property)) {
                $entityProperty->{$property} = $value;
            } else {
                throw new EntityPropertyUnknownException($property);
            }
        }

        return $entityProperty;
    }
}