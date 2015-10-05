<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class VoterActionRepository extends EntityRepository
{
    public function findAll($toArray = false)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder->select('voterAction')
            ->from('Inkstand\Bundle\CoreBundle\Entity\VoterAction', 'voterAction', 'voterAction.voterActionId');

        if($toArray) {
            return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
        }
        return $queryBuilder->getQuery()->getResult();
    }
}