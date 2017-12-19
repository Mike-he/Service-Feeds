<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedAttachmentRepository extends EntityRepository
{
    public function getAttachments(
       $feed
    ) {
        $query = $this->createQueryBuilder('fa')
            ->select('
                fa.id,
                fa.content,
                fa.attachmentType as attachment_type,
                fa.filename,
                fa.preview,
                fa.size
            ')
            ->where('fa.feed = :feed')
            ->setParameter('feed', $feed);

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }
}
