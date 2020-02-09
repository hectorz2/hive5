<?php
namespace App\Controller;

use App\Service\MainControllerServicesManager\MainControllerServicesManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /** @var KernelInterface */
    protected $kernel;

    /** @var Request */
    protected $request;

    /** @var ManagerRegistry */
    protected $doctrine;

    /** @var string */
    protected $projectDir;

    public function __construct(MainControllerServicesManager $mainControllerServicesManager)
    {
        $services = $mainControllerServicesManager->getServicesList();
        foreach ($services as $arg => $service) {
            if(property_exists($this, $arg)) {
                $this->{$arg} = $service;
            }
        }

        $this->projectDir = $this->kernel->getProjectDir();
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

    /**
     * @param string $entityClass
     * @return ObjectRepository
     */
    protected function getRepository($entityClass) {
        return $this->doctrine->getRepository($entityClass);
    }
}