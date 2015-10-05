<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoterActionRole
 *
 * @ORM\Table("lms_voter_action_role_assignment")
 * @ORM\Entity
 */
class VoterActionRoleAssignment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voter_action_role_assignment_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voterActionRoleAssignmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="voter_action_id", type="integer")
     */
    private $voterActionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer")
     */
    private $roleId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow", type="boolean")
     */
    private $allow;

    /**
     * @ORM\ManyToOne(targetEntity="VoterAction", inversedBy="voterActionRoleAssignments")
     * @ORM\JoinColumn(name="voter_action_id", referencedColumnName="voter_action_id")
     */
    private $voterAction;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="voterActionRoleAssignments")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     */
    private $role;

    /**
     * Get voterActionRoleAssignmentId
     *
     * @return integer 
     */
    public function getVoterActionRoleAssignmentId()
    {
        return $this->voterActionRoleAssignmentId;
    }

    /**
     * Set voterActionId
     *
     * @param integer $voterActionId
     * @return VoterActionRole
     */
    public function setVoterActionId($voterActionId)
    {
        $this->voterActionId = $voterActionId;

        return $this;
    }

    /**
     * Get voterActionId
     *
     * @return integer 
     */
    public function getVoterActionId()
    {
        return $this->voterActionId;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     * @return VoterActionRole
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return string 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set allow
     *
     * @param boolean $allow
     * @return VoterActionRole
     */
    public function setAllow($allow)
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return boolean 
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * Set voterAction
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterAction $voterAction
     * @return VoterActionRole
     */
    public function setVoterAction(\Inkstand\Bundle\CoreBundle\Entity\VoterAction $voterAction = null)
    {
        $this->voterAction = $voterAction;

        return $this;
    }

    /**
     * Get voterAction
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\VoterAction 
     */
    public function getVoterAction()
    {
        return $this->voterAction;
    }

    /**
     * Set role
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\Role $role
     * @return VoterActionRoleAssignment
     */
    public function setRole(\Inkstand\Bundle\CoreBundle\Entity\Role $role = null)
    {
        $this->role = $role;

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
