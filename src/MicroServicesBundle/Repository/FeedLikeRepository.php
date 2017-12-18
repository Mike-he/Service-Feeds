<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedLikeRepository extends EntityRepository
{

    public function getId(
        $feed,
        $user
    ) {
        $query = $this->createQueryBuilder('fl')
            ->select('fl.id')
            ->where('fl.feed = :feed')
            ->andWhere('fl.author = :author')
            ->setParameter('feed', $feed)
            ->setParameter('author', $user);

        $result = $query->getQuery()->getOneOrNullResult();

        return $result;
    }

    public function count(
        $feed
    ) {
        $query = $this->createQueryBuilder('fl')
            ->select('count(fl.id)')
            ->where('fl.feed = :feed')
            ->setParameter('feed', $feed);

        $result = $query->getQuery()->getSingleScalarResult();

        return $result;
    }
}
