<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoterActionRole
 *
 * @ORM\Table("voter_action_role")
 * @ORM\Entity
 */
class VoterActionRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voter_action_role_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voterActionRoleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="voter_action_id", type="integer")
     */
    private $voterActionId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=255)
     */
    private $roleName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow", type="boolean")
     */
    private $allow;

    /**
     * @ORM\ManyToOne(targetEntity="VoterAction", inversedBy="voterActionRoles")
     * @ORM\JoinColumn(name="voter_action_id", referencedColumnName="voter_action_id")
     */
    private $voterAction;

    /**
     * Get voterActionRoleId
     *
     * @return integer 
     */
    public function getVoterActionRoleId()
    {
        return $this->voterActionRoleId;
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
     * Set roleName
     *
     * @param string $roleName
     * @return VoterActionRole
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
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
}
