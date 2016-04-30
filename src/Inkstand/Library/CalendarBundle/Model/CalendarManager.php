<?php

namespace Inkstand\Library\CalendarBundle\Model;

use Doctrine\ORM\EntityRepository;

class CalendarManager implements CalendarManagerInterface
{
    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * CalendarManager constructor.
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns new calendar instance
     * 
     * @param string $code
     * @return CalendarInterface
     */
    public function create($code)
    {
        $class = $this->repository->getClassName();
        $calendar = new $class();
        $calendar->setCode($code);
        return $calendar;
    }

    /**
     * Update calendar
     * 
     * @param CalendarInterface $calendar
     */
    public function update(CalendarInterface $calendar)
    {
        $this->repository->update($calendar);
    }

    /**
     * @param $calendarId
     * @return CalendarInterface
     */
    public function findOneByCalendarId($calendarId)
    {
        $this->repository->findOneById($calendarId);
    }

    /**
     * @param string $code
     * @return CalendarInterface
     */
    public function findOneByCode($code)
    {
        return $this->repository->findOneByCode($code);
    }

    /**
     * Returns a calendar by code. If no calendar is found, a new one is created and returned.
     * 
     * @param string $code
     * @return CalendarInterface
     */
    public function getCalendar($code)
    {
        $calendar = $this->findOneByCode($code);
        
        if (empty($calendar)) {
            $calendar = $this->create($code);
        }

        $this->update($calendar);

        return $calendar;
    }
}