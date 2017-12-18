<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use MicroServicesBundle\Entity\Feed;
use MicroServicesBundle\Entity\FeedAttachment;
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

    /**
     * @param int $id
     *
     * @return mixed
     */
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

    /**
     * @param int    $owner
     * @param string $content
     * @param string $platform
     * @param string $location
     * @param array  $attachments
     *
     * @return int
     */
    public function create(
        $owner,
        $content,
        $platform,
        $location,
        $attachments = array()
    ) {
        $feed = new Feed();
        $feed->setOwner($owner);
        $feed->setContent($content);
        $feed->setPlatform($platform);
        $feed->setLocation($location);
        $feed->setCreationDate(new \DateTime('now'));

        $this->em->persist($feed);

        if ($attachments) {
            $this->addAttachments(
                $feed,
                $attachments
            );
        }

        $this->em->flush();

        return $feed->getId();
    }

    /**
     * @param int $id
     */
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

    private function addAttachments(
        $feed,
        $attachments
    ) {
        foreach ($attachments as $attachment) {
            $feedAttachment = new FeedAttachment();

            $feedAttachment->setFeed($feed);
            $feedAttachment->setContent($attachment['content']);
            $feedAttachment->setAttachmentType($attachment['attachment_type']);
            $feedAttachment->setFilename($attachment['filename']);
            $feedAttachment->setPreview($attachment['preview']);
            $feedAttachment->setSize($attachment['size']);

            $this->em->persist($feedAttachment);
        }
    }
}
