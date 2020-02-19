<?php

namespace App\Service\EntityApiManager\Entity;

use App\Service\EntityApiManager\Model\EntityProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
interface EntityInterface
{
    /**
     * EntityInterface constructor.
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine);

    /**
     * @return string
     */
    public function getEntityClass(): string;

    /**
     * @return ServiceEntityRepository
     */
    public function getRepository(): ServiceEntityRepository;

    /**
     * @return EntityProperty[]
     */
    public function getEntityProperties(): array;

    /**
     * @return string
     */
    public function getValidatorClass(): string;

    /**
     * @return string
     */
    public function getFormatterClass(): string;

    /**
     * @return string
     */
    public function getPersisterClass(): string;
}