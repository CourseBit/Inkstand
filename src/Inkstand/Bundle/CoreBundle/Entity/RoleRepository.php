<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class RoleRepository extends EntityRepository
{
    public function findAll($toArray = false)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder->select('role')
            ->from('Inkstand\Bundle\CoreBundle\Entity\Role', 'role', 'role.name');

        if($toArray) {
            return $queryBuilder->getQuery()->getResult(Query::HYDRATE_ARRAY);
        }
        return $queryBuilder->getQuery()->getResult();
    }
}