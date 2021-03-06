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

    public function getLikes(
        $feed
    ) {
        $query = $this->createQueryBuilder('l')
            ->select('l.author as authorId')
            ->where('l.feed = :feed')
            ->setParameter('feed', $feed);

        $query->orderBy('l.creationDate', 'ASC');

        $result = $query->getQuery()->getResult();

        return $result;
    }
}
