<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EntityBundle\User;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="admin_login")
     */
    public function indexAction(Request $request)
    {
        
        $object = new User();
        $form = $this->createFormBuilder($object)
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
            return $this->render('backend/tpl/login/index.html.twig',array('form'=> $form->createView()));
        }
                
                
        
    }
}
