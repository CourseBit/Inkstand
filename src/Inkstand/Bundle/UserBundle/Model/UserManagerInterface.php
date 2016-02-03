<?php

namespace Inkstand\Bundle\UserBundle\Model;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UserManagerInterface
{
    /**
     * Find user by criteria
     *
     * @param array $criteria
     * @return null|UserInterface
     */
    public function findUserBy(array $criteria);

    /**
     * Find one user by criteria
     *
     * @param array $criteria
     * @return null|UserInterface
     */
    public function findOneUserBy(array $criteria);

    /**
     * Find all users
     *
     * @return array
     */
    public function findUsers();

    /**
     * Return a single user by userId
     *
     * @param integer $userId
     * @return UserInterface
     */
    public function findOneByUserId($userId);

    /**
     * Delete a user
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function deleteUser(UserInterface $user);

    /**
     * Parse a spreadsheet file and add new users
     *
     * TODO: Move this to its own class
     *
     * @param UploadedFile $file
     * @return mixed
     */
    public function parseUserFile(UploadedFile $file);

    /**
     * Check if user is valid and return errors if present.
     *
     * @param UserInterface $user
     * @return bool
     */
    public function getUserValidationErrors(UserInterface $user);

    /**
     * Return errors from array of users
     *
     * @param $users
     * @return array
     */
    public function getUsersValidationErrors($users);

    /**
     * Checks if a User belongs to an Organization, optionally check children Organizations
     *
     * @param UserInterface $user
     * @param OrganizationInterface $organization
     * @param bool $recursive
     * @return boolean
     */
    public function belongsToOrganization(UserInterface $user, OrganizationInterface $organization, $recursive = true);
}