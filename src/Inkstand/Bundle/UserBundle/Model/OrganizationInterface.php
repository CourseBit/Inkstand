<?php

namespace Inkstand\Bundle\UserBundle\Model;

use FOS\UserBundle\Model\UserInterface;

interface OrganizationInterface
{
    public function getOrganizationId();
    public function setName($name);
    public function getName();
    public function setParentId($parentId);
    public function getParentId();
    public function addChild(OrganizationInterface $child);
    public function removeChild(OrganizationInterface $child);
    public function getChildren();
    public function setParent(OrganizationInterface $parent = null);
    public function getParent();
    public function addUser(UserInterface $user);
    public function removeUser(UserInterface $user);
    public function getUsers();
}