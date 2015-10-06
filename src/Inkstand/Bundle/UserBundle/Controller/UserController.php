<?php

namespace Inkstand\Bundle\UserBundle\Controller;

use Symfony\Component\Validator\Exception\MappingException;
use Inkstand\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/user/list", name="inkstand_user_list")
     */
    public function listAction()
    {
        $users = $this->get('user_service')->findAll();

        return $this->render('InkstandUserBundle:User:list.html.twig', array('users' => $users));
    }

    /**
     * @Route("/user/add", name="inkstand_user_add")
     */
    public function addAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $newUser = $userManager->createUser();
        $userForm = $this->createForm(new UserType(), $newUser);

        $userForm->handleRequest($request);

        if($userForm->isValid()) {
            $userManager->updateUser($newUser);

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('user.added', array('%name%' => $newUser->getUsername())));

            return $this->redirect($this->generateUrl('inkstand_user_list'));
        }

        return $this->render('InkstandUserBundle:User:add.html.twig', array(
            'userForm' => $userForm->createView()
        ));
    }

    /**
     * @Route("/user/edit/{userId}", name="inkstand_user_edit")
    */
    public function editAction(Request $request, $userId)
    {
        $user = $this->get('user_service')->findOneByUserId($userId);

        $this->denyAccessUnlessGranted('edit', $user, 'Unauthorized access!');

        if($user === null) {
            throw new NotFoundHttpException($this->get('translator')->trans('user.notfound'));
        }

        $userForm = $this->createForm(new UserType(true), $user, array(
            'action' => $this->generateUrl('inkstand_user_edit', array('userId' => $userId)),
            'method' => 'POST'
        ));

        $userForm->handleRequest($request);

        // TODO: Check if the cancel button was clicked

        if($userForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('user.edited', array('%name%' => $user->getUsername())));

            return $this->redirect($this->generateUrl('inkstand_user_list'));
        }

        return $this->render('InkstandUserBundle:User:edit.html.twig', array(
            'user' => $user,
            'userForm' => $userForm->createView(),
        ));
    }
}
