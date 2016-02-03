<?php

namespace Inkstand\Bundle\UserBundle\Model;


use FOS\UserBundle\Model\UserInterface;
use Inkstand\Bundle\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Exception\MappingException;

abstract class UserManager implements UserManagerInterface
{
    protected $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * Return a single user by userId
     *
     * @param integer $userId
     * @return UserInterface
     */
    public function findOneByUserId($userId)
    {
        return $this->findOneUserBy(array('id' => $userId));
    }

    /**
     * Converts UploadedFile of users into array of User objects
     *
     * TODO: Move this to its own class
     *
     * @param UploadedFile $file
     * @return null|array
     */
    public function parseUserFile(UploadedFile $file)
    {
        $data = array(
            'users' => array(),
            'columns' => array()
        );

        switch($file->getClientOriginalExtension()) {
            case 'csv':
                $file = $file->openFile();
                $data['columns'] = $file->fgetcsv();

                while(!$file->eof()) {
                    $user = new User();
                    $row = $file->fgetcsv();
                    if(array(null) == $row) {
                        continue;
                    }
                    foreach($row as $key => $userProperty) {
                        $functionName = 'set' . ucfirst($data['columns'][$key]);
                        if(!method_exists($user, $functionName)) {
                            throw new MappingException('User has no property ' . $data['columns'][$key]);
                        }
                        $user->$functionName($userProperty);
                    }
                    $data['users'][] = $user;
                }

                break;
        }

        return $data;
    }

    /**
     * Check if user is valid and return errors if present.
     *
     * @param UserInterface $user
     * @return bool
     */
    public function getUserValidationErrors(UserInterface $user)
    {
        $validator = $this->validator;
        $errors = $validator->validate($user);

        if(count($errors) > 0) {
            return $errors;
        }
    }

    /**
     * Return errors from array of users
     *
     * @param $users
     * @return array
     */
    public function getUsersValidationErrors($users)
    {
        $userErrorArray = array();
        foreach($users as $user) {
            $errors = $this->getUserValidationErrors($user);
            if(!empty($errors)) $userErrors[] = $errors;
        }

        return $userErrorArray;
    }

    /**
     * Checks if a User belongs to an Organization, optionally check children Organizations
     *
     * @param UserInterface $user
     * @param OrganizationInterface $organization
     * @param bool $recursive
     * @return boolean
     */
    public function belongsToOrganization(UserInterface $user, OrganizationInterface $organization, $recursive = true)
    {
        if(false === $recursive) {
            return $user->getOrganization() == $organization->getOrganizationId();
        }

        /** @var Organization $childOrganization */
        foreach($organization->getChildren() as $childOrganization) {
            if($childOrganization->getOrganizationId() == $user->getOrganizationId()) {
                return true;
            }
            $hasChildren = $childOrganization->getChildren();
            if(!empty($hasChildren)) {
                return $this->belongsToOrganization($user, $childOrganization);
            }
        }

        return false;
    }
}