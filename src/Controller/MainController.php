<?php
namespace App\Controller;

use App\Service\MainControllerServicesManager\MainControllerServicesManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /** @var KernelInterface */
    protected KernelInterface $kernel;

    /** @var Request */
    protected Request $request;

    /** @var ManagerRegistry */
    protected ManagerRegistry $doctrine;

    /** @var string */
    protected string $projectDir;

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
        return $this->render('projectSearch/projectSearch.html.twig');
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
     * @return ServiceEntityRepository
     */
    protected function getRepository($entityClass) {
        /** @var ServiceEntityRepository $repo */
        $repo = $this->doctrine->getRepository($entityClass);
        return $repo;
    }
}