<?php

namespace SO\PlatformBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
/**
 * ReponseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReponseRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByProposition(array $id) {
        $qb = $this->createQueryBuilder('reponse')
        ->innerJoin('reponse.proposition', 'proposition');
        $qb->where($qb->expr()->in('proposition.id', $id));

        return $qb->getQuery()->getResult();
    }

}
