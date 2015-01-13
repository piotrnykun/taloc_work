<?php

namespace EntityBundle;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Tools\CustomValidators\AdminLoginConstraint as AdminLoginAssert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_admin", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="admin_login", columns={"admin_login"})
 * })
 * 
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
     * @ORM\Column(type="string", length=100, unique = true)
     * @Assert\NotBlank(message="Pole wymagane")
     * @Assert\Length(min=3, max=100, minMessage = " Minimalna liczba znaków wynosi 3 ", maxMessage= " Maksymalna liczba znaków wynosi 100 "   )
     * @AdminLoginAssert\AdminLogin
     */
    protected $admin_login;
    
    /**
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Pole wymagane")
     * @Assert\Length(min=3, max=100, minMessage = " Minimalna liczba znaków wynosi 3 ", maxMessage= " Maksymalna liczba znaków wynosi 100 ")
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

    public $admin_save_me = false;
    
    public function __construct() {
        
    }
    
    /**
     * Get admin_id
     *
     * @return integer 
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * Set admin_login
     *
     * @param string $adminLogin
     * @return AdminUser
     */
    public function setAdminLogin($adminLogin)
    {
        $this->admin_login = $adminLogin;

        return $this;
    }

    /**
     * Get admin_login
     *
     * @return string 
     */
    public function getAdminLogin()
    {
        return $this->admin_login;
    }

    /**
     * Set admin_password
     *
     * @param string $adminPassword
     * @return AdminUser
     */
    public function setAdminPassword($adminPassword)
    {
        $this->admin_password = $adminPassword;

        return $this;
    }

    /**
     * Get admin_password
     *
     * @return string 
     */
    public function getAdminPassword()
    {
        return $this->admin_password;
    }

    /**
     * Set admin_is_global_admin
     *
     * @param boolean $adminIsGlobalAdmin
     * @return AdminUser
     */
    public function setAdminIsGlobalAdmin($adminIsGlobalAdmin)
    {
        $this->admin_is_global_admin = $adminIsGlobalAdmin;

        return $this;
    }

    /**
     * Get admin_is_global_admin
     *
     * @return boolean 
     */
    public function getAdminIsGlobalAdmin()
    {
        return $this->admin_is_global_admin;
    }

    /**
     * Set admin_date_add
     *
     * @param \DateTime $adminDateAdd
     * @return AdminUser
     */
    public function setAdminDateAdd(\DateTime $adminDateAdd = null)
    {
        $this->admin_date_add = $adminDateAdd;

        return $this;
    }

    /**
     * Get admin_date_add
     *
     * @return \DateTime 
     */
    public function getAdminDateAdd()
    {
        return $this->admin_date_add;
    }
}
