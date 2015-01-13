<?php

namespace Tools\CustomValidators\AdminLoginConstraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\DBAL\Connection;

/**
 * @Annotation
 */
class AdminLoginValidator extends ConstraintValidator 
{

    /**
     *
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $dbalConnection)  {

         $this->connection = $dbalConnection;
    }
    
    public function validate($array, Constraint $constraint)
    {
            try {
                $sql = 'SELECT * FROM tc_admin WHERE admin_login = :login AND admin_password = :password';
                $result = $this->connection->fetchAssoc($sql,array('login' => $login,'password' => $pass));
                
                if ( !$result ) {
                    throw new Exception('Podano niepoprawny login/hasło');
                } else {
                    return true;
                }
                
            } catch (Exception $ex) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%string%', $ex->getMessage())
                    ->addViolation();
            }
            

    }
    
}