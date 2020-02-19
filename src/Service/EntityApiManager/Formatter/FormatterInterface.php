<?php
namespace App\Service\EntityApiManager\Formatter;

use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
interface FormatterInterface
{
    /**
     * FormatterInterface constructor.
     * @param EntityInterface $entity
     * @param ManagerRegistry $doctrine
     */
    public function __construct(EntityInterface $entity, ManagerRegistry $doctrine);

    /**
     * Converts the data of the associative array to the real data that the Entity needs.
     * @param array $entityData
     * @return array An array with the data formatted to that the Entity needs
     * @throws EntityPropertyTypeNotSupportedException
     */
    public function formatToEntity(array $entityData): array;

    /**
     * Converts the data of the entity to associative array.
     * @param object $entity
     * @return array
     */
    public function formatFromEntity(object $entity): array;
}