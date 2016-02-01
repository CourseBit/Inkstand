<?php

namespace Inkstand\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table("lms_organization")
 * @ORM\Entity
 */
class Organization
{
    /**
     * @var integer
     *
     * @ORM\Column(name="organization_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $organizationId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId = null;

    /**
     * @ORM\OneToMany(targetEntity="Organization", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="organization_id", nullable=true)
     */
    private $parent;

    /**
     * Get organizationId
     *
     * @return integer 
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Organization
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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Organization
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Add children
     *
     * @param \Inkstand\Bundle\UserBundle\Entity\Organization $children
     * @return Organization
     */
    public function addChild(\Inkstand\Bundle\UserBundle\Entity\Organization $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Inkstand\Bundle\UserBundle\Entity\Organization $children
     */
    public function removeChild(\Inkstand\Bundle\UserBundle\Entity\Organization $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Inkstand\Bundle\UserBundle\Entity\Organization $parent
     * @return Organization
     */
    public function setParent(\Inkstand\Bundle\UserBundle\Entity\Organization $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Inkstand\Bundle\UserBundle\Entity\Organization 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
