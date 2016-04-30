<?php

namespace Inkstand\Library\CalendarBundle\Model;

abstract class Event implements EventInterface, \JsonSerializable
{
    /**
     * @var integer
     */
    protected $eventId;

    /**
     * @var integer
     */
    protected $calendarId;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var \DateTime
     */
    protected $start;

    /**
     * @var CalendarInterface
     */
    protected $calendar;

    /**
     * @var boolean
     */
    protected $allDay = false;

    /**
     * @var \DateTime
     */
    protected $end;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $rendering;

    /**
     * @var boolean
     */
    protected $overlap = false;

    public function jsonSerialize()
    {
        $data = [
            'id' => $this->getEventId(),
            'title' => $this->getTitle(),
            'start' => $this->getStart()->format(\DateTime::ISO8601),
            'allDay' => $this->getAllDay(),
        ];

        if (!empty($this->getEnd())) {
            $data['end'] = $this->getEnd()->format(\DateTime::ISO8601);
        }

        if (!empty($this->getUrl())) {
            $data['url'] = $this->getUrl();
        }

        if (!empty($this->getClassName())) {
            $data['className'] = $this->getClassName();
        }

        if (!empty($this->getRendering())) {
            $data['rendering'] = $this->getRendering();
        }

        return $data;
    }

    /**
     * Sets event data from array
     * 
     * @param array $data
     */
    public function fromArray(array $data)
    {
        $this->setTitle($data['title'])
            ->setStart(new \DateTime($data['start']))
            ->setAllDay($data['allDay']);

        if (array_key_exists('calendarId', $data)) {
            $this->setCalendarId($data['calendarId']);
        }

        if (array_key_exists('end', $data) && !empty($data['end'])) {
            $this->setEnd(new \DateTime($data['end']));
        }

        if (array_key_exists('url', $data)) {
            $this->setUrl($data['url']);
        }

//        if (array_key_exists('className', $data)) {
//            $this->setClassName($data['className']);
//        }

        if (array_key_exists('rendering', $data)) {
            $this->setRendering($data['rendering']);
        }
    }

    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set calendarId
     *
     * @param integer $calendarId
     * @return Event
     */
    public function setCalendarId($calendarId)
    {
        $this->calendarId = $calendarId;

        return $this;
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
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Event
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set calendar
     *
     * @param CalendarInterface $calendar
     * @return Event
     */
    public function setCalendar(CalendarInterface $calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return CalendarInterface
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set allDay
     *
     * @param boolean $allDay
     * @return Event
     */
    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;

        return $this;
    }

    /**
     * Get allDay
     *
     * @return boolean
     */
    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Event
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Event
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set className
     *
     * @param string $className
     * @return Event
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Get className
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Set rendering
     *
     * @param string $rendering
     * @return Event
     */
    public function setRendering($rendering)
    {
        $this->rendering = $rendering;

        return $this;
    }

    /**
     * Get rendering
     *
     * @return string
     */
    public function getRendering()
    {
        return $this->rendering;
    }

    /**
     * Set overlap
     *
     * @param boolean $overlap
     * @return Event
     */
    public function setOverlap($overlap)
    {
        $this->overlap = $overlap;

        return $this;
    }

    /**
     * Get overlap
     *
     * @return boolean
     */
    public function getOverlap()
    {
        return $this->overlap;
    }
}