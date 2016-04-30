<?php

namespace Inkstand\Library\CalendarBundle\Options;

class CalendarOptions implements \JsonSerializable
{
    private $eventSources = array();

    /**
     * Add event source to calendar
     *
     * @param EventSource $eventSource
     */
    public function addEventSource(EventSource $eventSource)
    {
        $this->eventSources[] = $eventSource;
    }
    
    public function jsonSerialize()
    {
        $eventSources = array();
        foreach ($this->eventSources as $eventSource) {
            $eventSources[] = $eventSource->jsonSerialize();
        }
        $data = array(
            'eventSources' => $eventSources
        );

        return $data;
    }
}