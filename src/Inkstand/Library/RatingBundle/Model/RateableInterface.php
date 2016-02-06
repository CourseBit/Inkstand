<?php
/**
 * Created by PhpStorm.
 * User: Catherine Conradt
 * Date: 2/5/2016
 * Time: 5:00 PM
 */

namespace Inkstand\Library\RatingBundle\Model;

/**
 * This interface designates a class that has ratings associated with it. Often another database model.
 *
 * Interface RateableInterface
 * @package Inkstand\Library\RatingBundle\Model
 */
interface RateableInterface
{
    /**
     * @return array Array of RatingInterface
     */
    public function getRatings();
}