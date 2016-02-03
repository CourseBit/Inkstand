<?php

namespace Inkstand\Bundle\UserBundle\Model;

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
}