<?php

namespace Inkstand\Library\CalendarBundle\Model;

use Inkstand\Library\CalendarBundle\Options\CalendarOptions;

abstract class Calendar implements CalendarInterface, \JsonSerializable
{
    /**
     * @var integer
     */
    protected $calendarId;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $events;

    /**
     * @var CalendarOptions
     */
    protected $calendarOptions;

    public function jsonSerialize()
    {
        $data = [
            'calendarId' => $this->getCalendarId(),
            'code' => $this->getCode(),
        ];

        $data['events'] = [];

        /** @var \JsonSerializable $event */
        foreach ($this->getEvents() as $event) {
            $data['events'][] = $event->jsonSerialize();
        }

        return $data;
    }

    /**
     * @return CalendarOptions
     */
    public function getCalendarOptions()
    {
        return $this->calendarOptions;
    }

    /**
     * @param CalendarOptions $calendarOptions
     */
    public function setCalendarOptions(CalendarOptions $calendarOptions)
    {
        $this->calendarOptions = $calendarOptions;
    }

    /**
     * Get calendarId
     *
     * @return integer
     */
    public function getCalendarId()
    {
        return $this->calendarId;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Calendar
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add events
     *
     * @param EventInterface $events
     * @return Calendar
     */
    public function addEvent(EventInterface $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param EventInterface $events
     */
    public function removeEvent(EventInterface $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}