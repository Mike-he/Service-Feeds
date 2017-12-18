<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

class FeedLikeService implements IRpcService
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
     * @param int $feed
     * @param int $user
     *
     * @return mixed
     */
    public function getId(
        $feed,
        $user
    ) {
        $feedLikeId = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->getId($feed, $user);

        $result = $feedLikeId ? $feedLikeId['id'] : null;

        return $result;
    }

    public function count(
        $feed
    ) {
        $count = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->count($feed);

        return (int) $count;
    }
}
