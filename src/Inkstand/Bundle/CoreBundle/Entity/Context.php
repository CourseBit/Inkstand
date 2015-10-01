<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Context
 *
 * @ORM\Table("context")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\ContextRepository")
 */
class Context
{
    /**
     * @var integer
     *
     * @ORM\Column(name="context_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $contextId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="integer")
     */
    private $objectId;

    /**
     * @var string
     *
     * @ORM\Column(name="context_type", type="string", length=255)
     */
    private $contextType;

    /**
     * @ORM\OneToMany(targetEntity="ContextRoleAssignment", mappedBy="context")
     */
    private $contextRoleAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contextRoleAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get contextId
     *
     * @return integer 
     */
    public function getContextId()
    {
        return $this->contextId;
    }

    /**
     * Set objectId
     *
     * @param integer $objectId
     * @return Context
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return integer 
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set contextType
     *
     * @param string $contextType
     * @return Context
     */
    public function setContextType($contextType)
    {
        $this->contextType = $contextType;

        return $this;
    }

    /**
     * Get contextType
     *
     * @return string 
     */
    public function getContextType()
    {
        return $this->contextType;
    }

    /**
     * Add contextRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment $contextRoleAssignments
     * @return Context
     */
    public function addContextRoleAssignment(\Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment $contextRoleAssignments)
    {
        $this->contextRoleAssignments[] = $contextRoleAssignments;

        return $this;
    }

    /**
     * Remove contextRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment $contextRoleAssignments
     */
    public function removeContextRoleAssignment(\Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment $contextRoleAssignments)
    {
        $this->contextRoleAssignments->removeElement($contextRoleAssignments);
    }

    /**
     * Get contextRoleAssignments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContextRoleAssignments()
    {
        return $this->contextRoleAssignments;
    }
}
