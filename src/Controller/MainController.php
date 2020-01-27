<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    protected $projectDir;

    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }

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