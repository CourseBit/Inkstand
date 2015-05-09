<?php

namespace Inkstand\Bundle\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CourseBundle\Entity\ItemRepository")
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $itemId;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer")
     */
    private $moduleId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_type_id", type="integer")
     */
    private $itemTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="items")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="module_id")
     */
    private $module;

    /**
     * Get itemId
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Item
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Item
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
     * Set description
     *
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set itemTypeId
     *
     * @param integer $itemTypeId
     * @return Item
     */
    public function setItemTypeId($itemTypeId)
    {
        $this->itemTypeId = $itemTypeId;

        return $this;
    }

    /**
     * Get itemTypeId
     *
     * @return integer 
     */
    public function getItemTypeId()
    {
        return $this->itemTypeId;
    }

    /**
     * Set module
     *
     * @param \Inkstand\Bundle\CourseBundle\Entity\Module $module
     * @return Item
     */
    public function setModule(\Inkstand\Bundle\CourseBundle\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Inkstand\Bundle\CourseBundle\Entity\Module 
     */
    public function getModule()
    {
        return $this->module;
    }
}
