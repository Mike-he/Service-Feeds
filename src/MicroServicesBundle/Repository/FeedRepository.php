<?php

namespace MicroServicesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class FeedRepository extends EntityRepository
{
    public function getFeeds(
        $platform,
        $users,
        $limit,
        $offset
    ) {
        $query = $this->createQueryBuilder('f')
            ->select('f')
            ->where('f.isDeleted = FALSE');

        if (!is_null($platform)) {
            $query->andWhere('f.platform = :platform')
                ->setParameter('platform', $platform);
        }

        if ($users) {
            $query->andWhere('f.owner in (:owners)')
                ->setParameter('owners', $users);
        }

        $query->orderBy('f.creationDate', 'DESC');

        if (!is_null($limit) && !is_null($offset)) {
            $query->setMaxResults($limit)
                ->setFirstResult($offset);
        }

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }

    public function getDetail(
        $id
    ) {
        $query = $this->createQueryBuilder('f')
            ->where('f.isDeleted = FALSE')
            ->andWhere('f.id = :id')
            ->setParameter('id', $id);

        $result = $query->getQuery()->getOneOrNullResult(2);

        return $result;
    }
}
