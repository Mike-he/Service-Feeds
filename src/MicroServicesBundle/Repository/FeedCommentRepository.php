<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedCommentRepository extends EntityRepository
{
    public function getComments(
        $feed,
        $limit,
        $offset
    ) {
        $query = $this->createQueryBuilder('fc')
            ->where('fc.feed = :feed')
            ->setParameter('feed', $feed);

        $query->orderBy('fc.creationDate', 'ASC');

        if (!is_null($limit) && !is_null($offset)) {
            $query->setMaxResults($limit)
                ->setFirstResult($offset);
        }

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }
}
