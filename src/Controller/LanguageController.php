<?php
namespace App\Controller;

use App\Entity\Language;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends MainController
{
    /**
     * @Route("/Language", name="getLanguages", methods={"GET"})
     */
    public function getLanguages()
    {
        return $this->json($this->getDoctrine()->getRepository(Language::class)->findAll());
    }
}