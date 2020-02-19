<?php

namespace App\Service\EntityApiManager\Entity;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Language;
use App\Entity\Role;
use App\Entity\User;
use App\Service\EntityApiManager\Formatter\MainFormatter;
use App\Service\EntityApiManager\Model\EntityProperty;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyMissingException;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyUnknownException;
use App\Service\EntityApiManager\Persister\MainPersister;
use App\Service\EntityApiManager\Validator\MainValidator;
use App\Service\EntityApiManager\Validator\ValidatorConstraints;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class UserApiEntity implements EntityInterface
{

    private ManagerRegistry $doctrine;

    private ?array $properties = null;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    public function getRepository(): ServiceEntityRepository
    {
        return $this->doctrine->getRepository(User::class);
    }

    /**
     * @inheritDoc
     * @throws EntityPropertyUnknownException
     * @throws EntityPropertyMissingException
     */
    public function getEntityProperties(): array
    {
        if($this->properties == null) {
            $this->properties = [
                'username' => EntityProperty::createEntityProperty([
                    'fieldName' => 'username',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => true,
                    'max' => 100,
                    'unique' => true
                ]),
                'email' => EntityProperty::createEntityProperty([
                    'fieldName' => 'email',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => true,
                    'unique' => true,
                    'constraints' => [
                        ValidatorConstraints::VALID_EMAIL
                    ]
                ]),
                'firstname' => EntityProperty::createEntityProperty([
                    'fieldName' => 'firstname',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => true,
                    'max' => 100
                ]),
                'lastname' => EntityProperty::createEntityProperty([
                    'fieldName' => 'lastname',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => true,
                    'max' => 200
                ]),
                'password' => EntityProperty::createEntityProperty([
                    'fieldName' => 'password',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => false,
                    'hash' => true,
                    'ignoreOnGet' => true
                ]),
                'birthDate' => EntityProperty::createEntityProperty([
                    'fieldName' => 'birthDate',
                    'type' => EntityProperty::TYPE_DATETIME,
                    'required' => false
                ]),
                'studies' => EntityProperty::createEntityProperty([
                    'fieldName' => 'studies',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => false,
                    'constraints' => [
                        ValidatorConstraints::VALID_JSON
                    ]
                ]),
                'jobs' => EntityProperty::createEntityProperty([
                    'fieldName' => 'jobs',
                    'type' => EntityProperty::TYPE_STRING,
                    'required' => false,
                    'constraints' => [
                        ValidatorConstraints::VALID_JSON
                    ]
                ]),
                'country' => EntityProperty::createEntityProperty([
                    'fieldName' => 'country',
                    'type' => EntityProperty::TYPE_ENTITY,
                    'targetEntityClass' => Country::class,
                    'required' => false
                ]),
                'city' => EntityProperty::createEntityProperty([
                    'fieldName' => 'city',
                    'type' => EntityProperty::TYPE_ENTITY,
                    'targetEntityClass' => City::class,
                    'required' => false
                ]),
                'languages' => EntityProperty::createEntityProperty([
                    'fieldName' => 'languages',
                    'type' => EntityProperty::TYPE_COLLECTION,
                    'targetEntityClass' => Language::class,
                    'addMethod' => 'addLanguage',
                    'required' => false
                ]),
                'roles' => EntityProperty::createEntityProperty([
                    'fieldName' => 'roles',
                    'type' => EntityProperty::TYPE_COLLECTION,
                    'targetEntityClass' => Role::class,
                    'addMethod' => 'addRole',
                    'required' => false
                ])
            ];
        }

        return $this->properties;
    }

    /**
     * @inheritDoc
     */
    public function getValidatorClass(): string
    {
        return MainValidator::class;
    }

    /**
     * @inheritDoc
     */
    public function getFormatterClass(): string
    {
        return MainFormatter::class;
    }

    /**
     * @inheritDoc
     */
    public function getPersisterClass(): string
    {
        return MainPersister::class;
    }
}