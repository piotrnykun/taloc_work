<?php

namespace Tools\CustomValidators\AdminLoginConstraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AdminLogin extends Constraint
{
    public $message = ' Niepoprany użytkownik / hasło ';
}