<?php

namespace Inkstand\System;

/**
 * A class that implements BundleFinderInterface is a way to dynamically load bundles without manually defining them.
 * @package Inkstand\System
 * @author Joseph Conradt (joseph.conradt@coursebit.net)
 */
interface BundleFinderInterface
{
    /**
     * Locate bundles
     * @param array $locationPaths Array of paths to look for bundles
     */
    public function locateBundles(array $locationPaths);
}