<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageTemplateWidget
 *
 * @ORM\Table("lms_page_template_widget")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\PageTemplateWidgetRepository")
 */
class PageTemplateWidget
{
    /**
     * @var integer
     *
     * @ORM\Column(name="page_template_widget_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pageTemplateWidgetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="page_template_id", type="integer")
     */
    private $pageTemplateId;

    /**
     * @var string
     *
     * @ORM\Column(name="widget_id", type="string", length=255)
     */
    private $widgetId;

    /**
     * @ORM\ManyToOne(targetEntity="PageTemplate", inversedBy="pageTemplateWidgets")
     * @ORM\JoinColumn(name="page_template_id", referencedColumnName="page_template_id")
     */
    private $pageTemplate;

    /**
     * Get pageTemplateWidgetId
     *
     * @return integer 
     */
    public function getPageTemplateWidgetId()
    {
        return $this->pageTemplateWidgetId;
    }

    /**
     * Set pageTemplateId
     *
     * @param integer $pageTemplateId
     * @return PageTemplateWidget
     */
    public function setPageTemplateId($pageTemplateId)
    {
        $this->pageTemplateId = $pageTemplateId;

        return $this;
    }

    /**
     * Get pageTemplateId
     *
     * @return integer 
     */
    public function getPageTemplateId()
    {
        return $this->pageTemplateId;
    }

    /**
     * Set widgetId
     *
     * @param string $widgetId
     * @return PageTemplateWidget
     */
    public function setWidgetId($widgetId)
    {
        $this->widgetId = $widgetId;

        return $this;
    }

    /**
     * Get widgetId
     *
     * @return string 
     */
    public function getWidgetId()
    {
        return $this->widgetId;
    }

    /**
     * Set pageTemplate
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\PageTemplate $pageTemplate
     * @return PageTemplateWidget
     */
    public function setPageTemplate(\Inkstand\Bundle\CoreBundle\Entity\PageTemplate $pageTemplate = null)
    {
        $this->pageTemplate = $pageTemplate;

        return $this;
    }

    /**
     * Get pageTemplate
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\PageTemplate 
     */
    public function getPageTemplate()
    {
        return $this->pageTemplate;
    }
}
