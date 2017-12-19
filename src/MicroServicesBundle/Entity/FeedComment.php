<?php

namespace MicroServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeedComment.
 *
 * @ORM\Table(name="feed_comment")
 * @ORM\Entity(repositoryClass="MicroServicesBundle\Repository\FeedCommentRepository")
 */
class FeedComment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="feed", type="integer")
     */
    private $feed;

    /**
     * @var int
     *
     * @ORM\Column(name="author", type="integer")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text")
     */
    private $payload;

    /**
     * @var int
     *
     * @ORM\Column(name="reply_to_user_id", type="integer", nullable=true)
     */
    private $replyToUserId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime", nullable=false)
     */
    private $creationDate;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param int $feed
     */
    public function setFeed($feed)
    {
        $this->feed = $feed;
    }

    /**
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param int $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return int
     */
    public function getReplyToUserId()
    {
        return $this->replyToUserId;
    }

    /**
     * @param int $replyToUserId
     */
    public function setReplyToUserId($replyToUserId)
    {
        $this->replyToUserId = $replyToUserId;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }
}
