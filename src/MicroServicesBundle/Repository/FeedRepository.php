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

    public function getDetail(
        $id
    ) {
        $query = $this->createQueryBuilder('f')
            ->where('f.id = :id')
            ->setParameter('id', $id);

        $result = $query->getQuery()->getOneOrNullResult(2);

        return $result;
    }
}
