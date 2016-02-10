<?php

namespace Inkstand\Library\RatingBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Library\RatingBundle\Model\RateableInterface;
use Inkstand\Library\RatingBundle\Model\RatingInterface;
use Inkstand\Library\RatingBundle\Model\RatingManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Used for embedding rating related presentation.
 *
 * Class RatingController
 * @package Inkstand\Library\RatingBundle\Controller
 */
class RatingController extends Controller
{
    /**
     * @Template
     * @param RateableInterface $rateable
     * @return array
     */
    public function renderRateableAction(RateableInterface $rateable)
    {
        /** @var RatingManagerInterface $ratingManager */
        $ratingManager = $this->get('inkstand_rating.rating_manager');

        return array(
            'value' => $ratingManager->getOverallRating($rateable)
        );
    }
}