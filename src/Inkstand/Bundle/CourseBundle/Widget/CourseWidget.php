<?php

namespace Inkstand\Bundle\CourseBundle\Widget;


use Inkstand\Bundle\CoreBundle\Widget\WidgetInterface;

class CourseWidget implements WidgetInterface
{
    public function getId()
    {
        return 'course_widget';
    }

    public function getName()
    {
        return 'course_widget.name';
    }

    public function getPartial()
    {
        return 'InkstandCourseBundle:partial:course_widget.html.twig';
    }

    public function getOrder()
    {

    }
}