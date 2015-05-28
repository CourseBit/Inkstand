<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    public function renderLogin(array $data)
    {
        $defaultData = array('_csrf_token' => $data['csrf_token']);

        $userLoginForm =  $this->get('form.factory')->createNamedBuilder('', 'form', $defaultData, array())
            ->setAction($this->generateUrl('fos_user_security_check'))
            ->add('_csrf_token', 'hidden')
            ->add('_username', 'text')
            ->add('_password', 'password')
            ->add('_remember_me', 'checkbox')
            ->add('_submit', 'submit')
            ->getForm();

        //$userLoginForm->get('_csrf_token')->setValue();

        $data['userLoginForm'] = $userLoginForm->createView();

        dump($data);

        return $this->render('InkstandUserBundle:Security:login.html.twig', $data);
    }
}