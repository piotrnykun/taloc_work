<?php

namespace EntityBundle;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#use Tools\CustomValidators\AdminLoginConstraint as AdminLoginAssert; @AdminLoginAssert\AdminLogin
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_user", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="user_username", columns={"user_username"})
 * })
 * 
 */
class User implements UserInterface, \Serializable {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $user_id;
    
    /**
     *
     * @ORM\Column(type="string", length=100, unique = true)
     * @Assert\NotBlank(message="Pole wymagane")
     * @Assert\Length(min=3, max=100, minMessage = " Minimalna liczba znaków wynosi 3 ", maxMessage= " Maksymalna liczba znaków wynosi 100 "   )
     * 
     */
    protected $user_username;
    
    /**
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Pole wymagane")
     * @Assert\Length(min=3, max=100, minMessage = " Minimalna liczba znaków wynosi 3 ", maxMessage= " Maksymalna liczba znaków wynosi 100 ")
     */
    protected $user_password;
    
    /**
     *
     * @ORM\Column(type="boolean")
     */
    protected $user_is_global_admin;
    
    /**
     *
     * @ORM\Column(type="datetime")
     */
    protected $user_date_add;
    

    public $user_save_me = false;
    
    public function __construct() {
        
    }
    
    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * Set user_login
     *
     * @param string $userLogin
     * @return User
     */
    public function setUserUsername($userLogin)
    {
        $this->user_username = $userLogin;

        return $this;
    }

    /**
     * Get user_login
     *
     * @return string 
     */
    public function getUserUsername()
    {
        return $this->user_username;
    }
    
    public function getUsername()
    {
        return $this->user_username;
    }

    /**
     * Set user_password
     *
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->user_password = $userPassword;

        return $this;
    }

    /**
     * Get user_password
     *
     * @return string 
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }
    
    public function getPassword()
    {
        return $this->user_password;
    }

    /**
     * Set user_is_global_admin
     *
     * @param boolean $userIsGlobalAdmin
     * @return User
     */
    public function setIsGlobalAdmin($userIsGlobalAdmin)
    {
        $this->user_is_global_admin = $userIsGlobalAdmin;

        return $this;
    }

    /**
     * Get user_is_global_admin
     *
     * @return boolean 
     */
    public function getIsGlobalAdmin()
    {
        return $this->user_is_global_admin;
    }

    /**
     * Set user_date_add
     *
     * @param \DateTime $userDateAdd
     * @return User
     */
    public function setDateAdd(\DateTime $userDateAdd = null)
    {
        $this->user_date_add = $userDateAdd;

        return $this;
    }

    /**
     * Get user_date_add
     *
     * @return \DateTime 
     */
    public function getDateAdd()
    {
        return $this->user_date_add;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    public function getSalt() {
        return null;
    }
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->user_id,
            $this->user_username,
            $this->user_password,

        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->user_id,
            $this->user_username,
            $this->user_password
        ) = unserialize($serialized);
    }
}
