<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use FOS\UserBundle\Controller\ResettingController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class ResettingController extends BaseController
{
    /**
     * {@inheritdoc}
     *
     * Override FOS request page to use fancy styling
     */
    public function requestAction()
    {
        $passwordResetForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('fos_user_resetting_send_email'))
            ->setMethod('POST')
            ->add('username', 'text', array(
                'label' => 'resetting.request.username',
            ))
            ->add('submit', 'submit', array(
                'label' => 'resetting.request.submit',
                'attr' => array('class' => 'btn-primary')
            ))
            ->getForm();

        return $this->render('InkstandUserBundle:Resetting:request.html.twig', array(
            'passwordResetForm' => $passwordResetForm->createView()
        ));
    }

    /**
     * {@inheritdoc}
     *
     * Override FOS send email action so we can add some custom logic
     */
    public function sendEmailAction(Request $request)
    {
        $username = $request->request->get('form')['username'];

        /** @var $user UserInterface */
        $user = $this->get('fos_user.user_manager')->findUserByUsernameOrEmail($username);

        if (null === $user) {
            $request->getSession()->getFlashBag()->add('error', $this->get('translator')->trans('resetting.request.invalid_username', array('%username%' => $username)));
            // Originally this returned the request view, instead we'll redirect
            return new RedirectResponse($this->generateUrl('fos_user_resetting_request'));
        }

        if ($user->isPasswordRequestNonExpired($this->container->getParameter('fos_user.resetting.token_ttl'))) {
            //return $this->render('InkstandUserBundle:Resetting:passwordAlreadyRequested.html.twig');
        }

        if (null === $user->getConfirmationToken()) {
            /** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
            $tokenGenerator = $this->get('fos_user.util.token_generator');
            $user->setConfirmationToken($tokenGenerator->generateToken());
        }

        $this->get('fos_user.mailer')->sendResettingEmailMessage($user);
        $user->setPasswordRequestedAt(new \DateTime());
        $this->get('fos_user.user_manager')->updateUser($user);

        return new RedirectResponse($this->generateUrl('fos_user_resetting_check_email',
            array('email' => $this->getObfuscatedEmail($user))
        ));
    }

    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction(Request $request)
    {
        $email = $request->query->get('email');

        if (empty($email)) {
            // the user does not come from the sendEmail action
            return new RedirectResponse($this->generateUrl('fos_user_resetting_request'));
        }

        return $this->render('InkstandUserBundle:Resetting:checkEmail.html.twig', array(
            'email' => $email,
        ));
    }
}