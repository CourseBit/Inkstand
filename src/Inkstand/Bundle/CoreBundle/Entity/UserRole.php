<?php

namespace Inkstand\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRole
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserRole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_role_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $userRoleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="roleId", type="integer")
     */
    private $roleId;

    /**
     * Get userRoleId
     *
     * @return integer 
     */
    public function getUserRoleId()
    {
        return $this->userRoleId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return UserRole
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
     * Set roleId
     *
     * @param integer $roleId
     * @return UserRole
     */
    public function setRoleId($roleId)
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
}
