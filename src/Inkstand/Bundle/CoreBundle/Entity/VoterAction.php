<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VoterAction
 *
 * @ORM\Table("voter_action")
 * @ORM\Entity
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
     * @ORM\OneToMany(targetEntity="VoterActionRole", mappedBy="voterAction")
     */
    private $voterActionRoles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->voterActionRoles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add voterActionRoles
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActionRole $voterActionRoles
     * @return VoterAction
     */
    public function addVoterActionRole(\Inkstand\Bundle\CoreBundle\Entity\VoterActionRole $voterActionRoles)
    {
        $this->voterActionRoles[] = $voterActionRoles;

        return $this;
    }

    /**
     * Remove voterActionRoles
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\VoterActionRole $voterActionRoles
     */
    public function removeVoterActionRole(\Inkstand\Bundle\CoreBundle\Entity\VoterActionRole $voterActionRoles)
    {
        $this->voterActionRoles->removeElement($voterActionRoles);
    }

    /**
     * Get voterActionRoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoterActionRoles()
    {
        return $this->voterActionRoles;
    }
}
