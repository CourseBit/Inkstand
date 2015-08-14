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
     * @author Joseph Conradt (joseph.conradt@coursebit.net)
     * @param WidgetInterface $widget
     */
    public function registerWidget(WidgetInterface $widget)
    {
        $this->widgets[$widget->getId()] = $widget;
    }

    /**
     * Called from WidgetService to get all the registered widgets
     *
     * @author Joseph Conradt (joseph.conradt@coursebit.net)
     * @return array
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}