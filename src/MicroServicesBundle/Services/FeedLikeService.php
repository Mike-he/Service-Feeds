<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use MicroServicesBundle\Entity\FeedLike;
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
     * @return int|null
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

    /**
     * @param int $feed
     *
     * @return int
     */
    public function count(
        $feed
    ) {
        $count = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->count($feed);

        return (int) $count;
    }

    /**
     * @param int $feed
     *
     * @return array
     */
    public function getAuthor(
        $feed
    ) {
        $result = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->getLikes($feed);

        return $result;
    }

    /**
     * @param int $feed
     * @param int $user
     *
     * @return int|null
     */
    public function create(
        $feed,
        $user
    ) {
        $like = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->findOneBy(array(
                'feed' => $feed,
                'author' => $user,
            ));
        if (is_null($like)) {
            $like = new FeedLike();
            $like->setFeed($feed);
            $like->setAuthor($user);
            $like->setCreationDate(new \DateTime('now'));

            $this->em->persist($like);
            $this->em->flush();
        }

        return $like->getId();
    }

    /**
     * @param int $feed
     * @param int $user
     */
    public function remove(
        $feed,
        $user
    ) {
        $like = $this->em
            ->getRepository('MicroServicesBundle:FeedLike')
            ->findOneBy(array(
                'feed' => $feed,
                'author' => $user,
            ));

        if ($like) {
            $this->em->remove($like);
            $this->em->flush();
        }
    }
}
