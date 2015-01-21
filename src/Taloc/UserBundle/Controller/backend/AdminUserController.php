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
            $search = false;
            $offset = false;
            $limit = false;
  
            /* 1) search: */
            if ( isset($_POST['search']) && (!empty($_POST['search']['value']))) {
                $search = $_POST['search']['value'];
            }
            
            if ( isset($_POST['length']) && (!empty($_POST['length']))) {
                $limit = $_POST['length'];
            }
            
            if ( isset($_POST['start']) && (!empty($_POST['start']))) {
                $offset = $_POST['start'];
            }
            
            
            $users = $this->getDoctrine()
                    ->getRepository('TalocUserBundle:User')
                    ->getAll($search,$offset,$limit);
            
            if ( !$users ) {
                throw new \Exception();
            }
            
            /* data for datatable: */
            return new Response(json_encode($users)); 
        
        } catch (\Exception $ex) {
            return new Response(json_encode(
                    
                    array(
                        'sEcho' => 0,
                        'iTotalRecords' => 0,
                        'recordsTotal' => 0,
                        'iTotalDisplayRecords' => 0,
                        'aaData' => array()
                    )
            )
                    
            ); 
        }
        
    }
    
    /**
     * 
     * @ROUTE("admin/user/edit/{id}", name="user_edit", defaults={"id" = null}, requirements={"id": "\d+" } )
     */
    public function userEdit($id)
    {
        
        return $this->render('TalocUserBundle:backend:user_edit.html.twig');
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
