<?php

namespace Tools\CustomValidators\AdminLoginConstraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
class AdminLoginValidator extends ConstraintValidator 
{

    public function validate($value, Constraint $constraint)
    {
        
        if ($value == 'admin') {
            
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            
        }
    }
    
}