<?php

namespace Taloc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_admin")
 * @ORM\Entity(repositoryClass="Taloc\UserBundle\Entity\AdminRepository")
 * 
 */
class Admin implements AdvancedUserInterface, \Serializable {
    
    /**
     * @ORM\Column(name="admin_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $admin_id;
    
    /**
     * @ORM\Column(name="admin_login", type="string",length=100, unique=true)
     * 
     */
    protected $admin_login;
    
    /**
     * @ORM\Column(name="admin_password",type="string", length=64)
     */
    protected $admin_password;
    
    /**
     * @ORM\Column(name="admin_status", type="boolean")
     */
    protected $admin_status;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="\Taloc\UserBundle\Entity\Role", inversedBy="role_admins")
     * @ORM\JoinTable(name="admin_roles",
     *      joinColumns={@ORM\JoinColumn(name="admin_id", referencedColumnName="admin_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")}
     *      )
     *
     */
    protected $admin_roles;
    
    public function __construct() {
        $this->admin_roles = new ArrayCollection();
    }
    
    /* UserInterface methods: */

    public function getUsername() {
        return $this->admin_login;
    }
    
    public function getAdminLogin() {
        return $this->admin_login;
    }
    
    public function setAdminLogin($admin_login) {
        $this->admin_login = $admin_login;
    }
    
    public function setAdminPassword($admin_pass) {
        $this->admin_password = $admin_pass;
    }
    
    public function getPassword() {
        return $this->admin_password;
    }
    
     public function getAdminPassword() {
        return $this->admin_password;
    }
    
    public function getSalt() {
        return null;
    }
    
    public function eraseCredentials() {
        
    }
    
    /* ROLES METHOD: */
    
    public function getRoles()
    {
        return $this->admin_roles->toArray();
    }
    
    
    /* AdvancedUserInterface method: */
    
    public function isAccountNonExpired() {
        return true;
    }
    
    public function isAccountNonLocked() {
        return true;
    }
    
    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->admin_status;
    }
    
    
    /* Serializable methods: */
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->admin_id,
            $this->admin_login,
            $this->admin_password,
            $this->admin_status

            /*
             * Add properties if exist
             */
             
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->admin_id,
            $this->admin_login,
            $this->admin_password,
            $this->admin_status
            /*
             * Add properties if exist
             */
        ) = unserialize($serialized);
    }
    
    public function getId() {
        return $this->admin_id;
    }
    
    
}
