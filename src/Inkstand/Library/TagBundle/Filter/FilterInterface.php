<?php

namespace Inkstand\Library\TagBundle\Filter;

interface FilterInterface
{
    public function getParameter();

    public function setParameter($parameter);

    public function getPossibleValues();
}