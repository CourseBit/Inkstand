<?php

namespace Inkstand\Bundle\UserBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Role;
use Inkstand\Bundle\CoreBundle\Entity\VoterActionRoleAssignment;
use Inkstand\Bundle\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Validator\Exception\MappingException;

/**
 * Service for user business logic
 *
 * Class UserService
 * @package Inkstand\Bundle\UserBundle\Service
 */
class UserService
{
    protected $entityManager;
    protected $userRepository;
    protected $validator;

    /**
     * @param $entityManager
     * @param $validator
     */
    public function __construct($entityManager, $validator)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('InkstandUserBundle:User');
        $this->validator = $validator;
    }

    /**
     * Return all users
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * Return a single user by userId
     *
     * @return
     */
    public function findOneByUserId($userId)
    {
        return $this->userRepository->findOneById($userId);
    }

    /**
     * Delete a single User
     *
     * @param User $user
     */
    public function deleteUser(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * Converts UploadedFile of users into array of User objects
     *
     * @param UploadedFile $file
     * @return array
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
                    $this->isUserValid($user);
                    $data['users'][] = $user;
                }

                break;
        }

        return $data;
    }

    /**
     * Check if user is valid and return errors if present.
     *
     * @param User $user
     * @return bool
     */
    public function getUserValidationErrors(User $user)
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
}
