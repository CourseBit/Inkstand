<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    public function renderLogin(array $data)
    {
        $defaultData = array('_csrf_token' => $data['csrf_token']);

        $userLoginForm =  $this->container->get('form.factory')->createNamedBuilder('', 'form', $defaultData, array())
            ->setAction($this->container->get('router')->generate('fos_user_security_check'))
            ->add('_csrf_token', 'hidden')
            ->add('_username', 'text')
            ->add('_password', 'password')
            ->add('_remember_me', 'checkbox', array(
                'required' => false
            ))
            ->add('_submit', 'submit', array(
                'attr' => array('class' => 'btn btn-primary')
            ))
            ->getForm();

        $data['userLoginForm'] = $userLoginForm->createView();

        return $this->container->get('templating')->renderResponse('InkstandUserBundle:Security:login.html.twig', $data);
    }
}