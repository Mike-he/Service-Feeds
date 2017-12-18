<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedAttachmentRepository extends EntityRepository
{
    public function getAttachments(
       $feed
    ){
        $query = $this->createQueryBuilder('fa')
            ->select('fa')
            ->where('fa.feed = :feed')
            ->setParameter('feed', $feed);

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }
}
