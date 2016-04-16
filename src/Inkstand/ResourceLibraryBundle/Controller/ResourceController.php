<?php

namespace Inkstand\ResourceLibraryBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Inkstand\Bundle\CoreBundle\Entity\Setting;
use Inkstand\Bundle\UserBundle\Entity\User;
use Inkstand\Library\RatingBundle\Entity\Rating;
use Inkstand\Library\RatingBundle\Model\UserReviewInterface;
use Inkstand\ResourceLibraryBundle\Entity\Resource;
use Inkstand\ResourceLibraryBundle\Form\Type\ResourceType;
use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Inkstand\ResourceLibraryBundle\Model\ResourceManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResourceController extends Controller
{
    /**
     * @Route("/library/resource/add", name="inkstand_resource_library_resource_add")
     * @Template
     */
    public function addAction(Request $request)
    {
        /** @var ResourceManagerInterface $resourceManager */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        /** @var ResourceInterface $resource */
        $resource = $resourceManager->create();

        $this->denyAccessUnlessGranted('add', $resource);

        /** @var FormInterface $resourceForm */
        $resourceForm = $resourceManager->getForm($resource);

        $resourceForm->handleRequest($request);

        if($resourceForm->isValid()) {
            // Also update tags that were manually added to form
            $resourceManager->updateWithForm($resource, $resourceForm);

            $this->addSuccessMessage('resource.added');

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'resourceForm' => $resourceForm->createView()
        );
    }

    /**
     * @Route("/library/resource/view/{resourceId}", name="inkstand_resource_library_resource_view")
     * @Template
     * @param Request $request
     * @param $resourceId
     * @return array
     */
    public function viewAction(Request $request, $resourceId)
    {
        return array();
    }

    /**
     * @Route("/library/resource/edit/{resourceId}", name="inkstand_resource_library_resource_edit")
     * @Template
     */
    public function editAction(Request $request, $resourceId)
    {
        /** @var ResourceManagerInterface $resourceManager */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');
        $resource = $resourceManager->findOneByResourceId($resourceId);

        if($resource === null) {
            throw new NotFoundHttpException('Resource not found.');
        }

        $this->denyAccessUnlessGranted('edit', $resource);

        /** @var FormInterface $resourceForm */
        $resourceForm = $resourceManager->getForm($resource);

        $resourceForm->handleRequest($request);

        if($resourceForm->isValid()) {
            // Also update tags that were manually added to form
            $resourceManager->updateWithForm($resource, $resourceForm);

            $this->addSuccessMessage('resource.added');

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'resourceForm' => $resourceForm->createView()
        );
    }

    /**
     * @Route("/library/resource/delete", name="inkstand_resource_library_resource_delete")
     * @Template
     */
    public function deleteAction()
    {

    }

    /**
     * @Route("/library/resource/download", name="inkstand_resource_library_resource_download")
     * @Template
     */
    public function downloadAction()
    {

    }

    /**
     * @Route("/library/resource/rate/{resourceId}", name="inkstand_resource_library_resource_rate")
     * @Template
     * @param Request $request
     * @param $resourceId
     * @throws NotFoundHttpException
     * @return array
     */
    public function rateAction(Request $request, $resourceId)
    {
        /** @var Resource $resource */
        $resource = $this->get('inkstand_resource_library.resource_manager')->findOneByResourceId($resourceId);

        if($resource === null) {
            throw new NotFoundHttpException('Resource not found.');
        }

        $rating = $resource->getRating();

        if(!$rating) {
            $rating = $this->get('inkstand_rating.rating_manager')->create();
            $resource->setRating($rating);
            $this->get('doctrine.orm.entity_manager')->persist($resource);
            $this->get('doctrine.orm.entity_manager')->flush();
            $resource = $this->get('inkstand_resource_library.resource_manager')->findOneByResourceId($resourceId);
        }

        $userReview = $this->get('inkstand_rating.user_review_manager')->findOneBy(array(
            'ratingId' => $rating->getRatingId(),
            'userId' => $this->getUser()->getId())
        );

        if(null === $userReview) {
            /** @var UserReviewInterface $userReview */
            $userReview = $this->get('inkstand_rating.user_review_manager')->create();
            $userReview->setRating($rating);
            $userReview->setRatingId($rating->getRatingId());
            $userReview->setUser($this->getUser());
            $userReview->setUserId($this->getUser()->getId());
        }

        $userReviewForm = $this->get('inkstand_rating.user_review_manager')->getForm($userReview);

        $userReviewForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

        if($userReviewForm->isValid()) {
            $this->get('inkstand_rating.user_review_manager')->update($userReview);

            $session = $request->getSession();
            $session->getFlashBag()->add('success', 'Review successfully submitted.');

            return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
        }

        return array(
            'resource' => $resource,
            'userReviewForm' => $userReviewForm->createView()
        );
    }

    /**
     * Render single Resource
     *
     * @Template
     * @param Resource $resource
     * @return array
     */
    public function renderAction(Resource $resource)
    {
        return array(
            'resource' => $resource
        );
    }

    /**
     * @Route("/library/resource/grid-columns-form", name="inkstand_resource_library_grid_columns_form")
     * @param Request $request
     * @return RedirectResponse
     */
    public function gridColumnsFormAction(Request $request)
    {
        /** @var ResourceManagerInterface $resourceManager */
        $resourceManager = $this->get('inkstand_resource_library.resource_manager');

        $gridColumnsForm = $resourceManager->getGridColumnsForm($this->generateUrl('inkstand_resource_library_grid_columns_form'), $this->getUser());

        $gridColumnsForm->handleRequest($request);

        /** @var User $user */
        $user = $this->getUser();
        if($user->getOrganization()) {
            // TODO: Use organization code when it's added
            $settingName = $user->getOrganization()->getName() . 'gridColumns';
        } else {
            $settingName = $user->getUsername() . 'gridColumns';
        }

        if($gridColumnsForm->isValid()) {
            $tagCodes = json_encode($gridColumnsForm->get('tags')->getData());

            $repository = $this->getDoctrine()->getRepository('Inkstand\Bundle\CoreBundle\Entity\Setting');
            $setting = $repository->findOneBy(array('name' => $settingName));
            if(empty($setting)) {
                $setting = new Setting();
            }

            $setting->setName($settingName);
            $setting->setValue($tagCodes);
            $this->getDoctrine()->getManager()->persist($setting);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirect($this->generateUrl('inkstand_resource_library_index'));
    }
}