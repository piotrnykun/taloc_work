<?php

namespace Taloc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_user")
 * 
 * 
 */
class User implements AdvancedUserInterface, \Serializable {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $user_id;
    
    /**
     * @ORM\Column(type="email",length=100, unique=true)
     * 
     */
    protected $user_email;
    
    /**
     * @ORM\Column(type="string",length=200, unique=true)
     * 
     */
    protected $user_facebook_code;
    
    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $user_password;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $user_status;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="role_users")
     *
     */
    protected $user_roles;
    
    public function __construct() {
        $this->user_roles = new ArrayCollection();
    }
    
    /* UserInterface methods: */

    public function getUsername() {
        return $this->user_email;
    }
    
    public function getPassword() {
        return $this->user_password;
    }
    
    public function getSalt() {
        return null;
    }
    
    public function eraseCredentials() {
        
    }
    
    /* ROLES METHOD: */
    
    public function getRoles()
    {
        return $this->user_roles->toArray();
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
        return $this->isActive;
    }
    
    
    /* Serializable methods: */
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->user_id,
            $this->user_email,
            $this->user_facebook_email,
            $this->user_password,
            $this->user_status

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
            $this->user_id,
            $this->user_email,
            $this->user_facebook_email,
            $this->user_password,
            $this->user_status
            /*
             * Add properties if exist
             */
        ) = unserialize($serialized);
    }
    
    
}
