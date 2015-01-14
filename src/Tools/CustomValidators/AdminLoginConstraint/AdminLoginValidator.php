<?php

namespace Tools\CustomValidators\AdminLoginConstraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\DBAL\Connection;
use Symfony\Component\Validator\Exception\ValidatorException;
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
                
                $login = $this->constraint->getLogin();
                $password = $this->constraint->getPassword();
                
                $sql = 'SELECT * FROM tc_admin WHERE admin_login = :login AND admin_password = :password';
                $result = $this->connection->fetchAssoc($sql,array('login' => $login,'password' => $password));
                
                if ( !$result ) {
                    throw new ValidatorException('Podano niepoprawny login/hasło');
                } else {
                    return true;
                }
                
            } catch (ValidatorException $ex) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%string%', $ex->getMessage())
                    ->addViolation();
            }
            

    }
    
}