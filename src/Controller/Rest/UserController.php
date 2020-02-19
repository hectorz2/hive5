<?php
namespace App\Controller\Rest;

use App\Entity\Language;
use App\Entity\User;
use App\Service\EntityApiManager\Entity\EntityInterface;
use App\Service\EntityApiManager\Entity\UserApiEntity;
use App\Service\EntityApiManager\Exception\EntityNotExistException;
use App\Service\EntityApiManager\Model\Exception\EntityPropertyTypeNotSupportedException;
use App\Service\EntityApiManager\Persister\Exception\AddMethodNotExistException;
use App\Service\EntityApiManager\Persister\Exception\SetterMethodNotExistException;
use App\Service\EntityApiManager\Validator\Exception\EntityFieldNotFoundException;
use App\Service\EntityApiManager\Validator\Exception\EntityPropertyKeyNotEqualThanPropertyFieldNameException;
use App\Service\EntityApiManager\Validator\Exception\EntityValidationFailedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller\Rest
 */
class UserController extends MainRestController
{
    /**
     * @inheritDoc
     */
    function getEntityClass()
    {
        return User::class;
    }

    /**
     * @inheritDoc
     */
    function getApiEntity(): EntityInterface
    {
        return new UserApiEntity($this->getDoctrine());
    }

    /**
     * @Route("/getUsers", name="getUsers")
     * @return JsonResponse
     */
    public function getAll()
    {
        return parent::getAll();
    }

    /**
     * @Route("/postUsers", name="postUsers")
     * @return JsonResponse
     * @throws EntityNotExistException
     * @throws EntityPropertyTypeNotSupportedException
     * @throws AddMethodNotExistException
     * @throws SetterMethodNotExistException
     * @throws EntityFieldNotFoundException
     * @throws EntityPropertyKeyNotEqualThanPropertyFieldNameException
     * @throws EntityValidationFailedException
     */
    public function post(): JsonResponse
    {
        return parent::post();
    }

}