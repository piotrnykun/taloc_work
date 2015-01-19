<?php

namespace Taloc\UserBundle\Controller\backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminUserController extends Controller {
   
    /**
     * 
     * @ROUTE("admin/users", name="users_list")
     */
    public function usersListAction()
    {
        
        return $this->render('TalocUserBundle:backend:users_list.html.twig');
    }
    
    /**
     * 
     * @ROUTE("admin/usersListAjax", name="users_list_ajax" )
     */
    /*condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'"*/
    public function usersListAjax()
    {
        try {
                
            $users = $this->getDoctrine()
                    ->getRepository('TalocUserBundle:User')
                    ->getAll();
                    
            return new Response(json_encode($users)); 
        
        } catch (Exception $ex) {
            return new Response(json_encode(array())); 
        }
        
    }    
    
    
    
    
    
    
    
    
    
    
    
    
}
