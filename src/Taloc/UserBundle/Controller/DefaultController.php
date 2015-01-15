<?php

namespace Taloc\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * 
     * @ROUTE("/test/{name}")
     */
    public function indexAction($name)
    {
        return $this->render('TalocUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
