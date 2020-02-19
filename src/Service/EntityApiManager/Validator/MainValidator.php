<?php
namespace App\Service\EntityApiManager\Validator;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class MainValidator implements ValidatorInterface
{
    protected EntityInterface $entity;
    protected ManagerRegistry $doctrine;

    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine)
    {
        $this->entity = $entity;
        $this->doctrine = $doctrine;
    }

    /**
     * @param array $entityData
     * @param int|null $id
     * @return bool
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws EntityValidationFailedException
     */
    public function validate(array $entityData, ?int $id = null): bool
    {
        $this->validateEntityProperties();
        $this->validateKeysExists($entityData);

        $errors = [];
        foreach ($entityData as $field => $value) {
            $return = $this->validateEntityField($field, $value, $id);
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
            if($property->required && (!in_array($property->fieldName, $entityDataKeys) || !in_array($field, $entityDataKeys))) {
                throw new EntityFieldNotFoundException($property->fieldName, $entityDataKeys);
            }
        }
    }

    /**
     * @param string $field
     * @param mixed $value
     * @param int|null $id
     * @return array Key/Value array with 2 keys. status: true|false. Is is or not validated. errors: array. String array of the errors found.
     * @throws EntityPropertyTypeNotSupportedException
     */
    private function validateEntityField(string $field, $value, ?int $id = null) {
        $ok = true;
        $errors = [];
        $entityProperty = $this->entity->getEntityProperties()[$field];

        $this->validateRequired($entityProperty, $value, $ok, $errors);

        if($value !== null) {
            $this->validateUnique($entityProperty, $value, $id, $ok, $errors);

            switch ($entityProperty->type) {
                case EntityProperty::TYPE_STRING:
                    $this->validateString($entityProperty, $value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_INT:
                    $this->validateInt($entityProperty, $value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_BOOL:
                    $this->validateBool($value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_ENTITY:
                    $this->validateEntity($entityProperty, $value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_DATETIME:
                    $this->validateDatetime($value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_COLLECTION:
                    $this->validateCollection($entityProperty, $value, $ok, $errors);
                    break;
                case EntityProperty::TYPE_FILE:
                    $this->validateFile($entityProperty, $value, $ok, $errors);
                    break;
                default:
                    throw new EntityPropertyTypeNotSupportedException($entityProperty->type);
            }

            $this->validateConstraints($entityProperty, $value, $ok, $errors);
        }

        return [
            'status' => $ok,
            'errors' => $errors
        ];
    }

    private function validateRequired(EntityProperty $entityProperty, string $value, bool &$ok, array &$errors) {
        if($entityProperty->required && $value === null) {
            $ok = false;
            $errors[] = 'validation.error.fieldIsRequiredAndIsEmpty';
        }
    }

    private function validateUnique(EntityProperty $entityProperty, string $value, ?int $id, bool &$ok, array &$errors) {
        if($entityProperty->unique != null && $entityProperty->unique) {
            $entity = $this->entity->getRepository()->findOneBy([
                $entityProperty->fieldName => $value
            ]);
            if($entity != null && ($id === null || $entity->getId() !== $id)) {
                $ok = false;
                $errors[] = 'validation.error.fieldIsUniqueAndAlreadyInUse';
            }
        }
    }

    private function validateString(EntityProperty $entityProperty, $value, bool &$ok, array &$errors) {
        if(!is_string($value)) {
            $ok = false;
            $errors[] = 'validation.error.noString';
        } else {
            if($entityProperty->min != null) {
                if(strlen($value) < $entityProperty->min) {
                    $ok = false;
                    $errors[] = [
                        'message' => 'validation.error.stringUnderMinSize',
                        'extraInfo' => $entityProperty->min
                    ];
                }
            }
            if($entityProperty->max != null) {
                if(strlen($value) > $entityProperty->max) {
                    $ok = false;
                    $errors[] = [
                        'message' => 'validation.error.stringExceedMaxSize',
                        'extraInfo' => $entityProperty->max
                    ];
                }
            }
        }
    }

    private function validateInt(EntityProperty $entityProperty, $value, bool &$ok, array &$errors) {
        if(!is_numeric($value)) {
            $ok = false;
            $errors[] = 'validation.error.noNumeric';
        } else {
            $intval = intval($value);
            if($entityProperty->min != null) {
                if($intval < $entityProperty->min) {
                    $ok = false;
                    $errors[] = [
                        'message' => 'validation.error.intUnderMinValue',
                        'extraInfo' => $entityProperty->min
                    ];
                }
            }
            if($entityProperty->max != null) {
                if($intval > $entityProperty->max) {
                    $ok = false;
                    $errors[] = [
                        'message' => 'validation.error.intExceedMaxValue',
                        'extraInfo' => $entityProperty->max
                    ];
                }
            }
        }
    }

    private function validateBool($value, bool &$ok, array &$errors) {
        $acceptedValues = [
            true,
            false,
            0,
            1,
            '0',
            '1',
            'true',
            'false'
        ];

        if(!in_array($value, $acceptedValues)) {
            $ok = false;
            $errors[] = 'validation.error.boolValueNotAccepted';
        }
    }

    private function validateEntity(EntityProperty $entityProperty, $value, bool &$ok, array &$errors) {
        if(!is_numeric($value)) {
            $ok = false;
            $errors[] = 'validation.error.valueHasToBeNumericalId';
        } else {
            $targetEntityClass = $entityProperty->targetEntityClass;
            $entity = $this->doctrine->getRepository($targetEntityClass)->find($value);
            if($entity == null) {
                $ok = false;
                $errors[] = 'validation.error.theIdGivenIsNotOneOfAValidEntity';
            }
        }
    }

    private function validateDatetime($value, bool &$ok, array &$errors) {
        if(!$value instanceof DateTime) {
            if(!is_string($value)) {
                $ok = false;
                $errors[] = 'validation.error.valueIsNotDatetimeAndIsNotString';
            } else {
                $acceptedFormats = [
                    'Y-m-d\TH:i:s',
                    'Y-m-d H:i:s'
                ];

                $accepted = true;
                foreach ($acceptedFormats as $acceptedFormat) {
                    if(!DateTime::createFromFormat($acceptedFormat, $value)) {
                        $accepted = false;
                    }
                }

                if(!$accepted) {
                    $ok = false;
                    $errors[] = 'validation.error.dateFormatIsNotValid';
                }
            }
        }
    }

    private function validateCollection(EntityProperty $entityProperty, $value, bool &$ok, array &$errors) {
        if(!$value instanceof Collection) {
            $targetEntityClass = $entityProperty->targetEntityClass;
            if(!is_string($value)) {
                $ok = false;
                $errors[] = 'validation.error.collectionIsNotAStringAndIsNotACollection';
            } else {
                $ids = explode(',', $value);
                foreach ($ids as $id) {
                    $id = trim($id);
                    $entity = $this->doctrine->getRepository($targetEntityClass)->find($id);
                    if($entity == null) {
                        $ok = false;
                        $errors[] = [
                            'message' => 'validation.error.theIdGivenIsNotOneOfAValidEntity',
                            'extraInfo' => $id
                        ];
                    }
                }
            }
        }
    }

    private function validateFile(EntityProperty $entityProperty, $value, bool &$ok, array &$errors) {
        //TODO
    }

    private function validateConstraints(EntityProperty $entityProperty, string $value, bool &$ok, array &$errors) {
        if($entityProperty->constraints != null) {
            foreach ($entityProperty->constraints as $function) {
                call_user_func_array(ValidatorConstraints::class . "::$function", [
                    'value' => $value,
                    'ok' => &$ok,
                    'errors' => &$errors
                ]);
            }
        }
    }


}