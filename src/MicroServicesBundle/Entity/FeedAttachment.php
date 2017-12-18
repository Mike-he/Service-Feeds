<?php

namespace MicroServicesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeedAttachment.
 *
 * @ORM\Table(name="feed_attachment")
 * @ORM\Entity(repositoryClass="MicroServicesBundle\Repository\FeedAttachmentRepository")
 */
class FeedAttachment
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
     * @var \MicroServicesBundle\Entity\Feed
     *
     * @ORM\ManyToOne(targetEntity="MicroServicesBundle\Entity\Feed")
     * @ORM\JoinColumn(name="feed_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $feed;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=256)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment_type", type="string", length=64)
     */
    private $attachmentType;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=64)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="string", length=256, nullable=true)
     */
    private $preview;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

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
     * @return Feed
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * @param Feed $feed
     */
    public function setFeed($feed)
    {
        $this->feed = $feed;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getAttachmentType()
    {
        return $this->attachmentType;
    }

    /**
     * @param string $attachmentType
     */
    public function setAttachmentType($attachmentType)
    {
        $this->attachmentType = $attachmentType;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}
