<?php

namespace Taloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Taloc\UserBundle\Entity\Admin;

class BackendController extends Controller
{
    /**
     * 
     * @ROUTE("/admin/", name="admin_homepage" )
     */
    public function indexAction()
    {
        return $this->render('TalocAppBundle:backend:base.html.twig');
    }
    
    /**
     *  @ROUTE("/admin/login", name="admin_login")
     */
    public function loginAction(Request $request) {
        
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                Security::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
        
        $object = new Admin();
        $form = $this->createFormBuilder($object)
                ->setAction('login_check')
                ->setMethod('post')
                ->add('admin_login', 'text',array(
                    'label' => ' ',
                    'required' => true,
                    'attr'   =>  array(
                        'class' => 'form-control',
                        'placeholder' => 'Login'
                    )
                   
                ))
                ->add('admin_password', 'password',array(
                    'label' => ' ',
                    'required' => true,
                    'attr'   =>  array(
                        'class' => 'form-control',
                        'placeholder' => 'Hasło'
                    )
                ))
                ->add('log_me', 'submit', array(
                    'label' => 'Zaloguj mnie',
                    'attr'   =>  array(
                        'class' => 'btn btn-login'
                    )
                ))
                ->getForm();
       
       
        $form->handleRequest($request);
        return $this->render('TalocAppBundle:backend:login.html.twig',array('form'=> $form->createView(),'error'=>$error));
        
    }
    
    /**
     * @Route("/admin/login_check", name="adminLoginCheck")
     */
    public function loginCheckAction()
    {
        
    }
    
    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logoutAction()
    {
        
    }
}
