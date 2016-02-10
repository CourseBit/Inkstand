<?php

namespace Inkstand\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkstand\Bundle\UserBundle\Model\OrganizationInterface;
use FOS\UserBundle\Model\UserInterface;

/**
 * Organization
 *
 * @ORM\Table("lms_organization")
 * @ORM\Entity
 */
class Organization implements OrganizationInterface
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
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    private $users;

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
     * Add child Organization
     *
     * @param OrganizationInterface $child
     * @return Organization
     */
    public function addChild(OrganizationInterface $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child Organization
     *
     * @param OrganizationInterface $child
     */
    public function removeChild(OrganizationInterface $child)
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
     * Set parent Organization
     *
     * @param OrganizationInterface $parent
     * @return Organization
     */
    public function setParent(OrganizationInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent Organization
     *
     * @return OrganizationInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add user
     *
     * @param UserInterface $user
     * @return Organization
     */
    public function addUser(UserInterface $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param UserInterface $user
     */
    public function removeUser(UserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
