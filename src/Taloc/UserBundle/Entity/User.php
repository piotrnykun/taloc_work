<?php

namespace Taloc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_user")
 * 
 * 
 */
class User extends BaseUser {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    public function __construct() {
        /* call BaseUser construct : */
        parent::__construct();
        
        $this->roles = array('ROLE_ADMIN');
    }
    
}
