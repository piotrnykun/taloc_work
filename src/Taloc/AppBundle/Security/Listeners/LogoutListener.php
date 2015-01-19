<?php

namespace Taloc\AppBundle\Security\Listeners;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface as LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutListener implements LogoutSuccessHandlerInterface {
    
    
    public function onLogoutSuccess(Request $request) {
        
        $referer = $request->headers->get('referer');
        $request->getSession()->getFlashBag()->add(
            'success_msg',
            'Wylogowano poprawnie'    
        );

        return new RedirectResponse($referer);
        
    }
    
}
