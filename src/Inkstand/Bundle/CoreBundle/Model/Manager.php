<?php

namespace Inkstand\Bundle\CoreBundle\Model;
use Doctrine\ORM\EntityRepository;

/**
 * Base manager that contains common used methods for object related managers.
 *
 * @package Inkstand\Bundle\CoreBundle\Model
 */
abstract class Manager
{
    /**
     * Implement method to return repository
     *
     * @return EntityRepository
     */
    public abstract function getRepository();

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOneById($id)
    {
        return $this->getRepository()->findOneById($id);
    }

    /**
     * Updates entity
     *
     * @param $entity
     */
    public function update($entity)
    {

        $this->getRepository()->update($entity);
    }

    /**
     * Deletes entity
     *
     * @param $entity
     * @throws \Exception
     */
    public function delete($entity)
    {
        $this->getRepository()->delete($entity);
    }
}