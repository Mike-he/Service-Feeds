<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedRepository extends EntityRepository
{
    public function getFeeds()
    {
        $query = $this->createQueryBuilder('f')
            ->select('f')
            ->where('f.isDeleted = FALSE');

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }
}
