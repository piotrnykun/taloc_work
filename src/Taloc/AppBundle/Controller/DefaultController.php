<?php

namespace Taloc\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * 
     * @ROUTE("/")
     */
    public function indexAction()
    {
        return $this->render('TalocAppBundle:Default:index.html.twig');
        
        /* działający serwis: */
        #$msgService = $this->get('test_service');
        #$msgService->sendMsg('testowa wiadomosc serwisu');
        
    }
}
