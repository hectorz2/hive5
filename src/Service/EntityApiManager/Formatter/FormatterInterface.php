<?php
namespace App\Service\EntityApiManager\Formatter;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
interface FormatterInterface
{
    public function getEntityClass(): string;
    public function format(array $entityData): object;
}