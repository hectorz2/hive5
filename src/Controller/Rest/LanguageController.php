<?php
namespace App\Controller\Rest;

use App\Entity\Language;
use App\Service\EntityApiManager\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LanguageController
 * @package App\Controller\Rest
 */
class LanguageController extends MainRestController
{
    /**
     * @inheritDoc
     */
    function getEntityClass()
    {
        return Language::class;
    }

    /**
     * @Route("/getLanguages", name="getLanguages")
     * @return JsonResponse
     */
    public function getAll()
    {
        return parent::getAll();
    }

    /**
     * @inheritDoc
     */
    function getApiEntity(): EntityInterface
    {
        // TODO: Implement getApiEntity() method.
    }
}