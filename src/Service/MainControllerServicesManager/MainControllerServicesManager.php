<?php


namespace App\Service\MainControllerServicesManager;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelInterface;

class MainControllerServicesManager
{

    private $servicesList = [];

    public function __construct(KernelInterface $kernel, RequestStack $requestStack, ManagerRegistry $doctrine)
    {
        $this->servicesList['kernel'] = $kernel;
        $this->servicesList['request'] = $requestStack->getCurrentRequest();
        $this->servicesList['doctrine'] = $doctrine;
    }

    /**
     * @return array
     */
    public function getServicesList() {
        return $this->servicesList;
    }
}