<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use MicroServicesBundle\Entity\Feed;
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
     * @return array
     */
    public function lists()
    {
        $feeds = $this->em
           ->getRepository('MicroServicesBundle:Feed')
           ->getFeeds();

        foreach ($feeds as &$feed) {
            $feed['creationDate'] = $feed['creationDate']->format(DATE_ISO8601);
        }

        return $feeds;
    }

    public function detail(
        $id
    ) {
        $feed = $this->em
            ->getRepository('MicroServicesBundle:Feed')
            ->getDetail($id);

        if ($feed) {
            $feed['creationDate'] = $feed['creationDate']->format(DATE_ISO8601);
        }

        return $feed;
    }

    public function remove(
        $id
    ) {
        /** @var Feed $feed */
        $feed = $this->em->getRepository('MicroServicesBundle:Feed')->find($id);

        if ($feed) {
            $feed->setIsDeleted(true);

            $this->em->persist($feed);
            $this->em->flush();
        }
    }
}
