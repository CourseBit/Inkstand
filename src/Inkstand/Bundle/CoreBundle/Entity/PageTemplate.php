<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageTemplate
 *
 * @ORM\Table("lms_page_template")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\PageTemplateRepository")
 */
class PageTemplate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="page_template_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pageTemplateId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="PageTemplateWidget", mappedBy="pageTemplate")
     */
    protected $pageTemplateWidgets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageTemplateWidgets = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return PageTemplate
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
     * Add pageTemplateWidgets
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\PageTemplateWidget $pageTemplateWidgets
     * @return PageTemplate
     */
    public function addPageTemplateWidget(\Inkstand\Bundle\CoreBundle\Entity\PageTemplateWidget $pageTemplateWidgets)
    {
        $this->pageTemplateWidgets[] = $pageTemplateWidgets;

        return $this;
    }

    /**
     * Remove pageTemplateWidgets
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\PageTemplateWidget $pageTemplateWidgets
     */
    public function removePageTemplateWidget(\Inkstand\Bundle\CoreBundle\Entity\PageTemplateWidget $pageTemplateWidgets)
    {
        $this->pageTemplateWidgets->removeElement($pageTemplateWidgets);
    }

    /**
     * Get pageTemplateWidgets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPageTemplateWidgets()
    {
        return $this->pageTemplateWidgets;
    }
}
