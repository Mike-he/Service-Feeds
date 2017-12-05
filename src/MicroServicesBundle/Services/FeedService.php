<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

class FeedService implements IRpcService
{

    private $container;

    private $doctrine;

    /** @var EntityManager $em */
    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->doctrine = $this->container->get('doctrine');
        $this->em = $this->doctrine->getManager();
    }

    /**
     * @return string
     */
   public function lists()
   {
       $feeds = $this->em
           ->getRepository('MicroServicesBundle:Feed')
           ->getFeeds();


       return $feeds;
   }
}