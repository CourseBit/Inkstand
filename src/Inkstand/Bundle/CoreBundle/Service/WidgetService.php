<?php

namespace Inkstand\Bundle\CoreBundle\Service;


use Inkstand\Bundle\CoreBundle\Event\WidgetEvent;
use Inkstand\Bundle\CoreBundle\Event\WidgetEvents;

class WidgetService
{
    protected $eventDispatcher;
    protected $widgets;

    public function __construct($eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function registerWidgets()
    {
        if($this->widgets != null) {
            return;
        }

        $event = new WidgetEvent();
        $this->eventDispatcher->dispatch(WidgetEvents::WIDGET_REGISTER, $event);

        $this->widgets = $event->getWidgets();
    }

    public function getWidgets()
    {
        $this->registerWidgets();

        return $this->widgets;
    }

    public function getWidgetById($widgetId)
    {
        $this->registerWidgets();

        if(array_key_exists($widgetId, $this->widgets)) {
            return $this->widgets[$widgetId];
        }

        return null;
    }
}