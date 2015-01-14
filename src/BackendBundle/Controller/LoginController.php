<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use EntityBundle\User;

class LoginController extends Controller
{
    
    /**
     * @Route("/login", name="admin_login")
     */
    public function loginAction(Request $request)
    {
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
        
        $object = new User();
        $form = $this->createFormBuilder($object)
                ->setAction('login')
                ->add('user_username', 'text',array(
                    'label' => ' ',
                    'required' => true,
                    'attr'   =>  array(
                        'class' => 'form-control',
                        'placeholder' => 'Login'
                    )
                   
                ))
                ->add('user_password', 'password',array(
                    'label' => ' ',
                    'required' => true,
                    'attr'   =>  array(
                        'class' => 'form-control',
                        'placeholder' => 'Hasło'
                    )
                ))
                ->add('user_save_me', 'checkbox', array(
                    'label' => 'Zapamiętaj mnie',
                    'mapped' => false,
                    'required' => false,
                    'attr'   =>  array(
                        'class' => 'form-control'
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
    
        if ($form->isValid()) {
            
            
            echo 'ok'; exit();
            
            
            
        } else {
            return $this->render('backend/tpl/login/index.html.twig',array('form'=> $form->createView(),'error'=>$error));
        }        
        
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        $session = $request->getSession();
        var_dump($session);exit();
        
    }
}
