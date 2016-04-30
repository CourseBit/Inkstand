<?php

namespace Inkstand\Library\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Library\CalendarBundle\Model\Calendar as BaseCalendar;

/**
 * Calendar
 */
class Calendar extends BaseCalendar
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
