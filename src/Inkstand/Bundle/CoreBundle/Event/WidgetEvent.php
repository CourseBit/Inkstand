<?php

namespace Inkstand\Bundle\CoreBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Inkstand\Bundle\CoreBundle\Widget\WidgetInterface;

class WidgetEvent extends Event
{
    protected $widgets = array();

    /**
     * Add a widget to the dashboard
     *
     * @param WidgetInterface $widget
     */
    public function registerWidget(WidgetInterface $widget)
    {
        $this->widgets[$widget->getId()] = $widget;
        dump($widget);
        dump($this->widgets);
    }

    /**
     * Called from WidgetService to get all the registered widgets
     *
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}