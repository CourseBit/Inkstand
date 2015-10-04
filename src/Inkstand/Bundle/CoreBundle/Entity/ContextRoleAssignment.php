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
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer")
     */
    private $roleId;

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
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="contextRoleAssignments")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     */
    private $role;

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
     * Set roleId
     *
     * @param integer $roleId
     * @return ContextRoleAssignment
     */
    public function setRole($roleId)
    {
        $this->roleId = $roleId;

        return $this;
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

    /**
     * Set roleId
     *
     * @param integer $roleId
     * @return ContextRoleAssignment
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
}
