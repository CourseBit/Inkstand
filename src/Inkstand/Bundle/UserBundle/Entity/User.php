<?php

namespace Inkstand\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table("lms_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string")
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string")
     */
    protected $lastname;

    /**
     * @ORM\OneToMany(targetEntity="Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment", mappedBy="user")
     */
    private $contextRoleAssignments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contextRoleAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
        $this->addRole("ROLE_ADMIN");
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            // BaseUser
            $this->email,
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            // User
            $this->firstname,
            $this->lastname
        ));
    }

    /**
     * Unserializes the user.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->email,
            $this->password,
            $this->salt,
            $this->usernameCanonical,
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
            $this->id,
            $this->firstname,
            $this->lastname
            ) = $data;
    }

    public function getRoles()
    {
        //return parent::getRoles();
        return array("ROLE_ADMIN");
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Add contextRoleAssignments
     *
     * @param \Inkstand\Bundle\CoreBundle\Entity\ContextRoleAssignment $contextRoleAssignments
     * @return User
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
