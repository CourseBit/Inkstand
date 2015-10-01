<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ContextRepository extends EntityRepository
{
    public function findContext($contextType, $objectId)
    {
        $queryBuilder = $this->_em->createQueryBuilder();

        $queryBuilder->select('ctx, cra')
            ->from('Inkstand\Bundle\CoreBundle\Entity\Context', 'ctx')
            ->leftJoin('ctx.contextRoleAssignments', 'cra')
            ->where('ctx.contextType = :contextType')
            ->andWhere('ctx.objectId = :objectId')
            ->andWhere('cra.userId = 1')
            ->setParameter('contextType', $contextType)
            ->setParameter('objectId', $objectId);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}