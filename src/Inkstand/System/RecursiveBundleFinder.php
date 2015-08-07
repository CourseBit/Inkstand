<?php

namespace Inkstand\System;
use Symfony\Component\Finder\Finder;

/**
 * This class finds bundles via recursive folder searching.
 * This is the most straightforward approach to loading bundles.
 *
 * @package Inkstand\System
 * @author Joseph Conradt (joseph.conradt@coursebit.net)
 */
class RecursiveBundleFinder implements BundleFinderInterface
{
    /**
     * {@inheritdoc}
     */
    public function locateBundles(array $locationPaths)
    {
        $locatedBundles = array();

        $finder = new Finder();
        $finder->files()->in($locationPaths)->name('inkstand_bundle.php');

        foreach($finder as $file) {
            $bundleConfig = require_once($file->getRealpath());

            if(!array_key_exists('bundle_class', $bundleConfig)) {
                throw new \Exception('Bundle config loaded but bundle_class was not present. ' . $file->getRealpath());
            }

            $locatedBundles[] = new $bundleConfig['bundle_class'];
        }

        return $locatedBundles;
    }
}