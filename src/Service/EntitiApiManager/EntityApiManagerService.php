<?php

namespace App\Service\EntitiApiManager;


use App\Service\EntitiApiManager\EntityValidator\EntityValidatorInterface;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 14/02/2020
 */
class EntityApiManagerService
{
    /**
     * @param int $id
     * @return object
     */
    protected function getOne(int $id): object {
        //TODO
    }

    /**
     * @return object[]
     */
    protected function getAll(): array {
        //TODO
    }

    /**
     * @param EntityValidatorInterface $entityValidator
     * @param array $data
     * @return object[]
     */
    protected function post(EntityValidatorInterface $entityValidator, array $data): array {
        //TODO
    }

    /**
     * @param EntityValidatorInterface $entityValidator
     * @param array $data
     * @return object[]
     */
    protected function put(EntityValidatorInterface $entityValidator, array $data): array {
        //TODO
    }

    /**
     * @param int $id
     */
    protected function delete(int $id) {
        //TODO
    }
}