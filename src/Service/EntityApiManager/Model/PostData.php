<?php

namespace App\Service\EntityApiManager\Model;

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Author: Héctor Zaragoza Arranz
 * Date: 17/02/2020
 */
class PostData
{
    public string $entityClass;
    public ValidatorInterface $validator;
    //public Formatter $validator;
    //public Persistor $validator;
    public array $data;
}