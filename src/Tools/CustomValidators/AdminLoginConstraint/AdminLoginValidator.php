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
    
    public function validate($value, Constraint $constraint)
    {
            
            $sql = 'SELECT * FROM tc_admin WHERE admin_login = :login';
            $result = $this->connection->fetchAssoc($sql,array('login' => $value));
            var_dump($result);exit();
        
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();

    }
    
}