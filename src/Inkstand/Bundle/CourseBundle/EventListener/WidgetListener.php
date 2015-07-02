<?php

namespace Inkstand\Bundle\CourseBundle\EventListener;


use Inkstand\Bundle\CoreBundle\Event\WidgetEvent;
use Inkstand\Bundle\CourseBundle\Widget\CourseWidget;

class WidgetListener
{
    public function onWidgetRegister(WidgetEvent $event)
    {
        $event->registerWidget(new CourseWidget());
    }
}