<?php

namespace App\Service\Hasher;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class Hasher
{
    const HASH_ALGORITHM = 'sha256';

    public static function hash(string $string): string {
        return hash(self::HASH_ALGORITHM, $string);
    }
}