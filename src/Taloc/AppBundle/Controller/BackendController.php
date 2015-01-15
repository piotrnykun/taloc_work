<?php

namespace Taloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BackendController extends Controller
{
    /**
     * 
     * @ROUTE("/admin/", name="admin_homepage" )
     */
    public function indexAction($param)
    {
        return $this->render('TalocAppBundle:backend:base.html.twig');
    }
}
