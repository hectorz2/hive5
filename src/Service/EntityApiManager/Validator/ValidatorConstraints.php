<?php

namespace App\Service\EntityApiManager\Validator;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 19/02/2020
 */
class ValidatorConstraints
{
    const VALID_EMAIL = 'validateEmail';
    const VALID_JSON = 'validateJson';

    public static function validateEmail(string $value, bool &$ok, array &$errors){
         if(!filter_var($value, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\./', $value)) {
            $ok = false;
            $errors[] = 'validation.error.invalidEmailFormat';
         }
    }

    public static function validateJson(string $value, bool &$ok, array &$errors) {
        json_decode($value);
        if(json_last_error() !== JSON_ERROR_NONE) {
            $ok = false;
            $errors[] = 'validation.error.invalidJSON';
        }
    }
}