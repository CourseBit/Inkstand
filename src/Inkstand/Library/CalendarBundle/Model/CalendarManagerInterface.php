<?php

namespace Inkstand\Library\CalendarBundle\Model;

interface CalendarManagerInterface
{
    /**
     * Returns new calendar instance
     *
     * @param string $code
     * @return CalendarInterface
     */
    public function create($code);

    /**
     * Update calendar
     *
     * @param CalendarInterface $calendar
     */
    public function update(CalendarInterface $calendar);

    /**
     * @param $calendarId
     * @return CalendarInterface
     */
    public function findOneByCalendarId($calendarId);

    /**
     * @param string $code
     * @return CalendarInterface
     */
    public function findOneByCode($code);

    /**
     * Returns a calendar by code. If no calendar is found, a new one is created and returned.
     *
     * @param string $code
     * @return CalendarInterface
     */
    public function getCalendar($code);
}