<?php

namespace Inkstand\Library\CalendarBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Inkstand\Library\CalendarBundle\Model\CalendarInterface;

/**
 * CalendarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CalendarRepository extends EntityRepository
{
    public function create()
    {
        $class = $this->getEntityName();
        return new $class;
    }

    public function update(CalendarInterface $calendar)
    {
        $this->getEntityManager()->persist($calendar);
        $this->getEntityManager()->flush();
    }

    public function findOneByCalendarId($calendarId)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('c, e')
            ->from($this->getEntityName(), 'c')
            ->leftJoin('c.events', 'e')
            ->where('c.calendarId = :calendarId')
            ->setParameter('calendarId', $calendarId);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
