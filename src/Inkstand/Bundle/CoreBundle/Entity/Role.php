<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table("lms_role")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\RoleRepository")
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId = null;

    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="role_id", nullable=true)
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="VoterActionRoleAssignment", mappedBy="role")
     */
    protected $voterActionRoleAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->voterActionRoleAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Role
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
     * Set label
     *
     * @param string $label
     * @return Role
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Role
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
     * Set parentId
     *
     * @param integer $parentId
     * @return Role
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
     * @param \Inkstand\Bundle\CoreBundle\Entity\Role $child
     * @return Role
     */
    public function addChild(\Inkstand\Bundle\CoreBundle\Entity\Role $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\Role $child
     */
    public function removeChild(\Inkstand\Bundle\CoreBundle\Entity\Role $child)
    {
        $this->children->removeElement($child);
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
     * @param \Inkstand\Bundle\CoreBundle\Entity\Role $parent
     * @return Role
     */
    public function setParent(\Inkstand\Bundle\CoreBundle\Entity\Role $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add voterActionRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment $voterActionRoleAssignments
     * @return Role
     */
    public function addVoterActionRoleAssignment(\Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment $voterActionRoleAssignments)
    {
        $this->voterActionRoleAssignments[] = $voterActionRoleAssignments;

        return $this;
    }

    /**
     * Remove voterActionRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment $voterActionRoleAssignments
     */
    public function removeVoterActionRoleAssignment(\Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment $voterActionRoleAssignments)
    {
        $this->voterActionRoleAssignments->removeElement($voterActionRoleAssignments);
    }

    /**
     * Get voterActionRoleAssignments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoterActionRoleAssignments()
    {
        return $this->voterActionRoleAssignments;
    }
}
