<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoterAction
 *
 * @ORM\Table("lms_voter_action")
 * @ORM\Entity(repositoryClass="Inkstand\Bundle\CoreBundle\Entity\VoterActionRepository")
 */
class VoterAction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="voter_action_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $voterActionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="voter_id", type="integer")
     */
    private $voterId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Voter", inversedBy="voterActions")
     * @ORM\JoinColumn(name="voter_id", referencedColumnName="voter_id")
     */
    private $voter;

    /**
     * @ORM\OneToMany(targetEntity="VoterActionRoleAssignment", mappedBy="voterAction", cascade={"remove"})
     */
    private $voterActionRoleAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->voterActionRoleAssignments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set voterId
     *
     * @param integer $voterId
     * @return VoterAction
     */
    public function setVoterId($voterId)
    {
        $this->voterId = $voterId;

        return $this;
    }

    /**
     * Get voterId
     *
     * @return integer 
     */
    public function getVoterId()
    {
        return $this->voterId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return VoterAction
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
     * Set voter
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\Voter $voter
     * @return VoterAction
     */
    public function setVoter(\Inkstand\Bundle\CoreBundle\Entity\Voter $voter = null)
    {
        $this->voter = $voter;

        return $this;
    }

    /**
     * Get voter
     *
     * @return \Inkstand\Bundle\CoreBundle\Entity\Voter 
     */
    public function getVoter()
    {
        return $this->voter;
    }

    /**
     * Add voterActionRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment $voterActionRoleAssignments
     * @return VoterAction
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
