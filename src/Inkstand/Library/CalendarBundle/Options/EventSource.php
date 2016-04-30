<?php

namespace Inkstand\Library\CalendarBundle\Options;

abstract class EventSource implements \JsonSerializable
{
    private $color;
    private $backgroundColor;
    private $borderColor;
    private $textColor;
    private $className;
    private $editable;
    private $startEditable;
    private $durationEditable;
    private $rendering;
    private $overlap;
    private $constraint;
    private $allDayDefault;

    public function jsonSerialize()
    {
        $data = array();
        if (null !== $this->color) $data['color'] = $this->color;
        if (null !== $this->backgroundColor) $data['backgroundColor'] = $this->backgroundColor;
        if (null !== $this->borderColor) $data['borderColor'] = $this->borderColor;
        if (null !== $this->textColor) $data['textColor'] = $this->textColor;
        if (null !== $this->className) $data['color'] = $this->className;
        if (null !== $this->editable) $data['editable'] = $this->editable;
        if (null !== $this->startEditable) $data['startEditable'] = $this->startEditable;
        if (null !== $this->durationEditable) $data['durationEditable'] = $this->durationEditable;
        if (null !== $this->rendering) $data['rendering'] = $this->rendering;
        if (null !== $this->overlap) $data['overlap'] = $this->overlap;
        if (null !== $this->constraint) $data['color'] = $this->constraint;
        if (null !== $this->allDayDefault) $data['color'] = $this->allDayDefault;

        return $data;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param mixed $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return mixed
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    /**
     * @param mixed $borderColor
     */
    public function setBorderColor($borderColor)
    {
        $this->borderColor = $borderColor;
    }

    /**
     * @return mixed
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * @param mixed $textColor
     */
    public function setTextColor($textColor)
    {
        $this->textColor = $textColor;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * @param mixed $editable
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;
    }

    /**
     * @return mixed
     */
    public function getStartEditable()
    {
        return $this->startEditable;
    }

    /**
     * @param mixed $startEditable
     */
    public function setStartEditable($startEditable)
    {
        $this->startEditable = $startEditable;
    }

    /**
     * @return mixed
     */
    public function getDurationEditable()
    {
        return $this->durationEditable;
    }

    /**
     * @param mixed $durationEditable
     */
    public function setDurationEditable($durationEditable)
    {
        $this->durationEditable = $durationEditable;
    }

    /**
     * @return mixed
     */
    public function getRendering()
    {
        return $this->rendering;
    }

    /**
     * @param mixed $rendering
     */
    public function setRendering($rendering)
    {
        $this->rendering = $rendering;
    }

    /**
     * @return mixed
     */
    public function getOverlap()
    {
        return $this->overlap;
    }

    /**
     * @param mixed $overlap
     */
    public function setOverlap($overlap)
    {
        $this->overlap = $overlap;
    }

    /**
     * @return mixed
     */
    public function getConstraint()
    {
        return $this->constraint;
    }

    /**
     * @param mixed $constraint
     */
    public function setConstraint($constraint)
    {
        $this->constraint = $constraint;
    }

    /**
     * @return mixed
     */
    public function getAllDayDefault()
    {
        return $this->allDayDefault;
    }

    /**
     * @param mixed $allDayDefault
     */
    public function setAllDayDefault($allDayDefault)
    {
        $this->allDayDefault = $allDayDefault;
    }
}