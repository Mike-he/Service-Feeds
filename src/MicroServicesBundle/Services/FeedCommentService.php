<?php

namespace MicroServicesBundle\Services;

use Doctrine\ORM\EntityManager;
use MicroServicesBundle\Entity\FeedComment;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

class FeedCommentService implements IRpcService
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
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function lists(
        $feed,
        $limit,
        $offset
    ) {
        $comments = $this->em
            ->getRepository('MicroServicesBundle:FeedComment')
            ->getComments(
                $feed,
                $limit,
                $offset
            );

        foreach ($comments as &$comment) {
            $comment['creationDate'] = $comment['creationDate']->format(DATE_ISO8601);
        }

        return $comments;
    }

    /**
     * @param int    $feed
     * @param int    $author
     * @param string $payload
     * @param int    $reply
     *
     * @return array
     */
    public function create(
        $feed,
        $author,
        $payload,
        $reply = null
    ) {
        $comment = new FeedComment();
        $comment->setFeed($feed);
        $comment->setAuthor($author);
        $comment->setPayload($payload);
        $comment->setCreationDate(new \DateTime('now'));

        if (!is_null($reply)) {
            $comment->setReplyToUserId($reply);
        }

        $this->em->persist($comment);
        $this->em->flush();

        $result = array(
            'id' => $comment->getId(),
            'creationDate' => $comment->getCreationDate()->format(DATE_ISO8601),
        );

        return $result;
    }

    /**
     * @param int $feed
     * @param int $comment
     * @param int $user
     */
    public function remove(
        $feed,
        $comment,
        $user
    ) {
        $comment = $this->em
            ->getRepository('MicroServicesBundle:FeedComment')
            ->findOneBy(array(
                'id' => $comment,
               'feed' => $feed,
                'author' => $user,
            ));

        if ($comment) {
            $this->em->remove($comment);
            $this->em->flush();
        }
    }
}
