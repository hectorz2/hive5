<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function root()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/elements", name="elements")
     */
    public function elements()
    {
        return $this->render('elements.html.twig');
    }
}