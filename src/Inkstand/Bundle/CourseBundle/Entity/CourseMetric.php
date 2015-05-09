<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CourseMetric
 *
 * @ORM\Table(name="course_metric")
 * @ORM\Entity
 */
class CourseMetric
{
    /**
     * @var integer
     *
     * @ORM\Column(name="courseMetricId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $courseMetricId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="valueType", type="string", length=45)
     */
    private $valueType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="searchable", type="boolean")
     */
    private $searchable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="required", type="boolean")
     */
    private $required;


    /**
     * Get courseMetricId
     *
     * @return integer 
     */
    public function getCourseMetricId()
    {
        return $this->courseMetricId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Metric
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set metricType
     *
     * @param string $metricType
     * @return Metric
     */
    public function setMetricType($metricType)
    {
        $this->metricType = $metricType;

        return $this;
    }

    /**
     * Get metricType
     *
     * @return string 
     */
    public function getMetricType()
    {
        return $this->metricType;
    }

    /**
     * Set valueType
     *
     * @param string $valueType
     * @return Metric
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;

        return $this;
    }

    /**
     * Get valueType
     *
     * @return string 
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * Set searchable
     *
     * @param boolean $searchable
     * @return Metric
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * Get searchable
     *
     * @return boolean 
     */
    public function getSearchable()
    {
        return $this->searchable;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return Metric
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean 
     */
    public function getRequired()
    {
        return $this->required;
    }
}
