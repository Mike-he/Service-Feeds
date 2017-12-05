<?php

namespace MicroServicesBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

class FeedService implements IRpcService
{

    private $container;
    private $doctrine;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
    }

    /**
     * @return string
     */
   public function lists()
   {
        return 'All Data';
   }
}