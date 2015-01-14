<?php

namespace Tools\CustomValidators\AdminLoginConstraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AdminLogin extends Constraint
{
    public $message = ' Niepoprany użytkownik / hasło ';
    
    protected $login;
    protected $password;
    
    public function construct($options) {
        
        try {
            if ( $options['login'] ) {
                $this->login = $options['login'];
            }

             if ( $options['password'] ) {
                $this->password = $options['password'];
            }
        } catch (Exception $ex) { }
    }
    
    public function validatedBy()
    {
        return 'admin_login_check';
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function getPass() {
        return $this->password;
    }
    
}