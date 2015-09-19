<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use Symfony\Component\Validator\Exception\MappingException;
use Inkstand\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    /**
     * @Route("/user/upload", name="inkstand_user_upload")
     */
    public function uploadAction(Request $request)
    {
        $uploadForm = $this->createFormBuilder()
            ->add('attachment', 'file')
            ->add('submit', 'submit', array(
                'label' => 'user.upload.submit',
                'attr' => array('class' => 'btn-primary')
            ))
            ->getForm();

        $confirmForm = null;

        $uploadForm->handleRequest($request);

        if($uploadForm->isValid()) {
            $spreadsheet = $uploadForm['attachment']->getData();

            try {
                $userData = $this->get('user_service')->parseUserFile($spreadsheet);
            } catch(MappingException $e) {
                $request->getSession()->getFlashBag()->add('error', $e->getMessage());
            }

            if(count($userData['users']) == 0) {
                $request->getSession()->getFlashBag()->add('error', $this->get('translator')->trans('user.no_users_uploaded'));
            }

            $userErrors = $this->get('user_service')->getUsersValidationErrors($userData['users']);

            if(!empty($userErrors)) {
                return $this->render('InkstandUserBundle:Upload:upload-errors.html.twig', array('userErrors' => $userErrors));
            }

            $id = uniqid('uploadedUsers');
            $request->getSession()->set($id, serialize($userData));

            return $this->redirect($this->generateUrl('inkstand_user_upload_confirm', array('sessionKey' => $id)));
        }

        return $this->render('InkstandUserBundle:Upload:upload.html.twig', array(
            'uploadForm' => $uploadForm->createView()
        ));
    }

    /**
     * @Route("/user/upload/confirm/{sessionKey}", name="inkstand_user_upload_confirm")
     * @param Request $request
     * @param string $sessionKey Index of session to get uploaded users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadConfirmAction(Request $request, $sessionKey)
    {
        $userData = unserialize($request->getSession()->get($sessionKey));

        $confirmForm = $this->createFormBuilder()
            ->add('sessionId', 'hidden')
            ->add('generatePassword', 'choice', array(
                'choices' => array(1 => 'yes', 0 => 'no')
            ))
            ->add('submit', 'submit', array(
                'label' => 'user.upload.submit',
                'attr' => array('class' => 'btn-primary')
            ))->getForm()->createView();

        return $this->render('InkstandUserBundle:Upload:confirm.html.twig', array(
            'users' => $userData['users'],
            'userColumns' => $userData['columns'],
            'confirmForm' => $confirmForm
        ));
    }
}