<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_admin")
 */
class AdminUser {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $admin_id;
    
    /**
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $admin_login;
    
    /**
     *
     * @ORM\Column(type="string", length=100)
     */
    protected $admin_password;
    
    /**
     *
     * @ORM\Column(type="boolean")
     */
    protected $admin_is_global_admin;
    
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $admin_date_add;
    
    
}