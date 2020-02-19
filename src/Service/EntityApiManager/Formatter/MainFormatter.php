<?php

namespace App\Service\EntityApiManager\Formatter;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use App\Service\Hasher\Hasher;
use BadMethodCallException;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class MainFormatter implements FormatterInterface
{
    const MODE_TO_ENTITY = 1;
    const MODE_FROM_ENTITY = 2;
    
    protected EntityInterface $entity;
    protected ManagerRegistry $doctrine;
    
    /**
     * @inheritDoc
     */
    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine)
    {
        $this->entity = $entity;
        $this->doctrine = $doctrine;
    }

    /**
     * @inheritDoc
     */
    public function formatToEntity(array $entityData): array
    {
        $formattedEntityData = [];
        foreach ($entityData as $field => $value) {
            $entityProperty = $this->entity->getEntityProperties()[$field];

            $formattedValue = $this->formatEntityField($field, $value, self::MODE_TO_ENTITY);
            if($entityProperty->hash != null && $entityProperty->hash) {
                $formattedValue = Hasher::hash($formattedValue);
            }
            $formattedEntityData[$field] = $formattedValue;
        }
        
        return $formattedEntityData;
    }

    /**
     * @inheritDoc
     * @throws EntityPropertyTypeNotSupportedException
     */
    public function formatFromEntity(object $entity): array
    {
        $formattedFromEntityData = [];
        $entityProperties = $this->entity->getEntityProperties();
        foreach ($entityProperties as $field => $entityProperty) {
            if($entityProperty->ignoreOnGet != null && $entityProperty->ignoreOnGet) {
                continue;
            }

            if($entityProperty->type !== EntityProperty::TYPE_COLLECTION) {
                if($entityProperty->getterMethod == null) {
                    $method = 'get' . ucfirst($field);
                } else {
                    $method = $entityProperty->getterMethod;
                }

                $value = $entity->{$method}();
                $formattedValue = $this->formatEntityField($field, $value, self::MODE_FROM_ENTITY);
                $formattedFromEntityData[$field] = $formattedValue;
            }
        }

        return $formattedFromEntityData;
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param int $mode
     * @return mixed
     * @throws EntityPropertyTypeNotSupportedException
     * @throws Exception
     */
    private function formatEntityField(string $field, $value, int $mode) {
        if($value == null) {
            return null;
        }
        
        $entityProperty = $this->entity->getEntityProperties()[$field];

        $formattedValue = null;
        switch ($entityProperty->type) {
            case EntityProperty::TYPE_STRING:
                $formattedValue = $this->formatString($value);
                break;
            case EntityProperty::TYPE_INT:
                $formattedValue = $this->formatInt($value);
                break;
            case EntityProperty::TYPE_BOOL:
                $formattedValue = $this->formatBool($value, $mode);
                break;
            case EntityProperty::TYPE_ENTITY:
                $formattedValue = $this->formatEntity($entityProperty, $value, $mode);
                break;
            case EntityProperty::TYPE_DATETIME:
                $formattedValue = $this->formatDatetime($value, $mode);
                break;
            case EntityProperty::TYPE_COLLECTION:
                $formattedValue = $this->formatCollection($entityProperty, $value, $mode);
                break;
            case EntityProperty::TYPE_FILE:
                $formattedValue = $this->formatFile($value, $mode);
                break;
            default:
                throw new EntityPropertyTypeNotSupportedException($entityProperty->type);
        }
        
        return $formattedValue;
    }

    /**
     * @param string $value
     * @return string
     */
    private function formatString(string $value): string {
        return $value;
    }

    /**
     * @param mixed $value
     * @return int
     */
    private function formatInt($value): int {
        return intval($value);
    }

    /**
     * @param mixed $value
     * @param int $mode
     * @return bool|string
     */
    private function formatBool($value, int $mode) {
        if($mode === self::MODE_TO_ENTITY) {
            return $value === 'true' || $value === 1 || $value === '1' || $value === true;
        } else {
            return $value ? 'true' : 'false';
        }

    }

    /**
     * @param EntityProperty $entityProperty
     * @param int|object $value
     * @param int $mode
     * @return object|int
     */
    private function formatEntity(EntityProperty $entityProperty, $value, int $mode) {
        $targetEntityClass = $entityProperty->targetEntityClass;

        if($mode === self::MODE_TO_ENTITY) {
            return $this->doctrine->getRepository($targetEntityClass)->find($value);
        } else {
            return $value->getId();
        }
    }

    /**
     * @param string|DateTime $value
     * @param int|DateTime $mode
     * @return DateTime|string
     * @throws Exception
     */
    private function formatDateTime($value, int $mode) {
        if($mode === self::MODE_TO_ENTITY) {
            if($value instanceof DateTime) {
                return $value;
            }

            return new DateTime($value);
        } else {
            return $value->format('Y-m-d H:i:s');
        }
    }

    /**
     * @param EntityProperty $entityProperty
     * @param Collection|string $value
     * @param int $mode
     * @return array
     */
    private function formatCollection(EntityProperty $entityProperty, $value, int $mode): array {
        if($mode === self::MODE_FROM_ENTITY) {
            throw new BadMethodCallException('The collection could not be formatted from entity');
        }
        $collection = [];
        if($value instanceof Collection) {
             foreach ($value as $entity) {
                 $collection[] = $entity;
             }
        } else {
            $ids = explode(',', $value);
            foreach ($ids as $id) {
                $id = trim($id);
                $entity = $this->doctrine->getRepository($entityProperty->targetEntityClass)->find($id);
                $collection[] = $entity;
            }
        }

        return $collection;
    }

    /**
     * @param $value
     * @param int $mode
     */
    private function formatFile($value, int $mode) {
        //TODO
    }
}