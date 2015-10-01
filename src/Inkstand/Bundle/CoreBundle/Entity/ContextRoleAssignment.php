<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContextRoleAssignment
 *
 * @ORM\Table("context_role_assignment")
 * @ORM\Entity
 */
class ContextRoleAssignment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="context_role_assignment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $contextRoleAssignmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="context_id", type="integer")
     */
    private $contextId;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Context", inversedBy="contextRoleAssignments")
     * @ORM\JoinColumn(name="context_id", referencedColumnName="context_id")
     */
    private $context;

    /**
     * @ORM\ManyToOne(targetEntity="Inkstand\Bundle\UserBundle\Entity\User", inversedBy="contextRoleAssignments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Get contextRoleAssignmentId
     *
     * @return integer 
     */
    public function getContextRoleAssignmentId()
    {
        return $this->contextRoleAssignmentId;
    }

    /**
     * Set contextId
     *
     * @param integer $contextId
     * @return ContextRoleAssignment
     */
    public function setContextId($contextId)
    {
        $this->contextId = $contextId;

        return $this;
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
     * Set role
     *
     * @param string $role
     * @return ContextRoleAssignment
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ContextRoleAssignment
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set context
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\Context $context
     * @return ContextRoleAssignment
     */
    public function setContext(\Inkstand\Bundle\CoreBundle\Entity\Context $context = null)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\Context 
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set user
     *
     * @param \Inkstand\Bundle\UserBundle\Entity\User $user
     * @return ContextRoleAssignment
     */
    public function setUser(\Inkstand\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Inkstand\Bundle\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
