<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('inkstand_course_homepage', new Route('/hello/{name}', array(
    '_controller' => 'InkstandCourseBundle:Default:index',
)));

$collection->add('inkstand_course_index', new Route('/course', array(
	'_controller' => 'InkstandCourseBundle:Course:index',
)));

$collection->add('inkstand_course_add', new Route('/course/add', array(
	'_controller' => 'InkstandCourseBundle:Course:add',
)));

$collection->add('inkstand_course_view', new Route('/course/{slug}', array(
	'_controller' => 'InkstandCourseBundle:Course:view',
)));

return $collection;
