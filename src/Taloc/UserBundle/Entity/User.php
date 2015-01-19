<?php

namespace Taloc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="tc_user")
 * @ORM\Entity(repositoryClass="Taloc\UserBundle\Entity\UserRepository")
 * 
 */
class User implements AdvancedUserInterface, \Serializable {
    
    /**
     * @ORM\Column(name="user_id", type="integer" )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $user_id;
    
    /**
     * @ORM\Column(name="user_email", type="string",length=100, unique=true)
     * 
     */
    protected $user_email;
    
    /**
     * @ORM\Column(name="user_facebook_code", type="string",length=200, unique=true)
     * 
     */
    protected $user_facebook_code;
    
    /**
     * @ORM\Column(name="user_password",type="string", length=64)
     */
    protected $user_password;
    
    /**
     * @ORM\Column(name="user_status", type="boolean")
     */
    protected $user_status;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="\Taloc\UserBundle\Entity\Role", inversedBy="role_users")
     * @ORM\JoinTable(name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="role_id")}
     *      )
     *
     */
    protected $user_roles;
    
    /**
     * @ORM\Column(name="user_sex", type="string", length=1 )
     */
    protected $user_sex;
    
    /**
     * @ORM\Column(name="user_by_email_activate", type="boolean" )
     */
    protected $user_by_email_activate = 0;
    
    /**
     * @ORM\Column(name="user_type", type="string" )
     */
    protected $user_type = "standard";
    
    /**
     * @ORM\Column(name="user_is_company", type="boolean"  )
     */
    protected $user_is_company = 0;
    
    /**
     * @ORM\Column(name="user_first_name", type="string", length=255  )
     */
    protected $user_first_name;
    
    /**
     * @ORM\Column(name="user_last_name", type="string", length=255  )
     */
    protected $user_last_name;
    
    /**
     * @ORM\Column(name="user_street", type="string", length=100  )
     */
    protected $user_street;
    
    /**
     * @ORM\Column(name="user_building_nr", type="string", length=45  )
     */
    protected $user_building_nr;
    
    /**
     * @ORM\Column(name="user_house_nr", type="string", length=45  )
     */
    protected $user_house_nr;
    
    /**
     * @ORM\Column(name="user_post_code", type="string", length=45  )
     */
    protected $user_post_code;
    
    /**
     * @ORM\Column(name="user_city", type="string", length=100  )
     */
    protected $user_city;
    
    /**
     * @ORM\Column(name="user_phone", type="string", length=100  )
     */
    protected $user_phone;
    
    /**
     * @ORM\Column(name="user_nip", type="string", length=45  )
     */
    protected $user_nip;
    
    /**
     * @ORM\Column(name="user_facture_first_name", type="string", length=255  )
     */
    protected $user_facture_first_name;
    
    /**
     * @ORM\Column(name="user_facture_last_name", type="string", length=255  )
     */
    protected $user_facture_last_name;
    
    /**
     * @ORM\Column(name="user_facture_is_company", type="boolean"  )
     */
    protected $user_facture_is_company = 0;
    
    /**
     * @ORM\Column(name="user_facture_street", type="string", length=100  )
     */
    protected $user_facture_street;
    
    /**
     * @ORM\Column(name="user_facture_building_nr", type="string", length=45  )
     */
    protected $user_facture_building_nr;
    
    /**
     * @ORM\Column(name="user_facture_house_nr", type="string", length=45  )
     */
    protected $user_facture_house_nr;
    
    /**
     * @ORM\Column(name="user_facture_post_code", type="string", length=45  )
     */
    protected $user_facture_post_code;
    
    /**
     * @ORM\Column(name="user_facture_city", type="string", length=100  )
     */
    protected $user_facture_city;
    
    /**
     * @ORM\Column(name="user_facture_phone", type="string", length=100  )
     */
    protected $user_facture_phone;
    
    /**
     * @ORM\Column(name="user_facture_nip", type="string", length=100  )
     */
    protected $user_facture_nip;
    
    /**
     * @ORM\Column(name="user_accept_regulations", type="boolean"  )
     */
    protected $user_accept_regulations = 1;
    
    /**
     * @ORM\Column(name="user_accept_newsletter", type="boolean" )
     */
    protected $user_accept_newsletter = 0;
    
    /**
     * @ORM\Column(name="user_date_add", type="datetime" )
     */
    protected $user_date_add;
            
    /**
     * @ORM\Column(name="user_object_type", type="string"  )
     */
    protected $user_object_type = "user";

    public function __construct() {
        $this->user_roles = new ArrayCollection();
    }
    
    /* UserInterface methods: */

    public function getUsername() {
        return $this->user_email;
    }
    
    public function getUserEmail() {
        return $this->user_email;
    }
    
    public function getPassword() {
        return $this->user_password;
    }
    
     public function getUserPassword() {
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
        return $this->user_status;
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
            $this->user_facebook_code,
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
            $this->user_facebook_code,
            $this->user_password,
            $this->user_status
            /*
             * Add properties if exist
             */
        ) = unserialize($serialized);
    }
    
    public function getId() {
        return $this->user_id;
    }
    
    

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user_email
     *
     * @param string $userEmail
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->user_email = $userEmail;

        return $this;
    }

    /**
     * Set user_facebook_code
     *
     * @param string $userFacebookCode
     * @return User
     */
    public function setUserFacebookCode($userFacebookCode)
    {
        $this->user_facebook_code = $userFacebookCode;

        return $this;
    }

    /**
     * Get user_facebook_code
     *
     * @return string 
     */
    public function getUserFacebookCode()
    {
        return $this->user_facebook_code;
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
     * Set user_status
     *
     * @param boolean $userStatus
     * @return User
     */
    public function setUserStatus($userStatus)
    {
        $this->user_status = $userStatus;

        return $this;
    }

    /**
     * Get user_status
     *
     * @return boolean 
     */
    public function getUserStatus()
    {
        return $this->user_status;
    }

    /**
     * Set user_sex
     *
     * @param string $userSex
     * @return User
     */
    public function setUserSex($userSex)
    {
        $this->user_sex = $userSex;

        return $this;
    }

    /**
     * Get user_sex
     *
     * @return string 
     */
    public function getUserSex()
    {
        return $this->user_sex;
    }

    /**
     * Set user_by_email_activate
     *
     * @param boolean $userByEmailActivate
     * @return User
     */
    public function setUserByEmailActivate($userByEmailActivate)
    {
        $this->user_by_email_activate = $userByEmailActivate;

        return $this;
    }

    /**
     * Get user_by_email_activate
     *
     * @return boolean 
     */
    public function getUserByEmailActivate()
    {
        return $this->user_by_email_activate;
    }

    /**
     * Set user_type
     *
     * @param string $userType
     * @return User
     */
    public function setUserType($userType)
    {
        $this->user_type = $userType;

        return $this;
    }

    /**
     * Get user_type
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->user_type;
    }

    /**
     * Set user_is_company
     *
     * @param boolean $userIsCompany
     * @return User
     */
    public function setUserIsCompany($userIsCompany)
    {
        $this->user_is_company = $userIsCompany;

        return $this;
    }

    /**
     * Get user_is_company
     *
     * @return boolean 
     */
    public function getUserIsCompany()
    {
        return $this->user_is_company;
    }

    /**
     * Set user_first_name
     *
     * @param string $userFirstName
     * @return User
     */
    public function setUserFirstName($userFirstName)
    {
        $this->user_first_name = $userFirstName;

        return $this;
    }

    /**
     * Get user_first_name
     *
     * @return string 
     */
    public function getUserFirstName()
    {
        return $this->user_first_name;
    }

    /**
     * Set user_last_name
     *
     * @param string $userLastName
     * @return User
     */
    public function setUserLastName($userLastName)
    {
        $this->user_last_name = $userLastName;

        return $this;
    }

    /**
     * Get user_last_name
     *
     * @return string 
     */
    public function getUserLastName()
    {
        return $this->user_last_name;
    }

    /**
     * Set user_street
     *
     * @param string $userStreet
     * @return User
     */
    public function setUserStreet($userStreet)
    {
        $this->user_street = $userStreet;

        return $this;
    }

    /**
     * Get user_street
     *
     * @return string 
     */
    public function getUserStreet()
    {
        return $this->user_street;
    }

    /**
     * Set user_building_nr
     *
     * @param string $userBuildingNr
     * @return User
     */
    public function setUserBuildingNr($userBuildingNr)
    {
        $this->user_building_nr = $userBuildingNr;

        return $this;
    }

    /**
     * Get user_building_nr
     *
     * @return string 
     */
    public function getUserBuildingNr()
    {
        return $this->user_building_nr;
    }

    /**
     * Set user_house_nr
     *
     * @param string $userHouseNr
     * @return User
     */
    public function setUserHouseNr($userHouseNr)
    {
        $this->user_house_nr = $userHouseNr;

        return $this;
    }

    /**
     * Get user_house_nr
     *
     * @return string 
     */
    public function getUserHouseNr()
    {
        return $this->user_house_nr;
    }

    /**
     * Set user_post_code
     *
     * @param string $userPostCode
     * @return User
     */
    public function setUserPostCode($userPostCode)
    {
        $this->user_post_code = $userPostCode;

        return $this;
    }

    /**
     * Get user_post_code
     *
     * @return string 
     */
    public function getUserPostCode()
    {
        return $this->user_post_code;
    }

    /**
     * Set user_city
     *
     * @param string $userCity
     * @return User
     */
    public function setUserCity($userCity)
    {
        $this->user_city = $userCity;

        return $this;
    }

    /**
     * Get user_city
     *
     * @return string 
     */
    public function getUserCity()
    {
        return $this->user_city;
    }

    /**
     * Set user_phone
     *
     * @param string $userPhone
     * @return User
     */
    public function setUserPhone($userPhone)
    {
        $this->user_phone = $userPhone;

        return $this;
    }

    /**
     * Get user_phone
     *
     * @return string 
     */
    public function getUserPhone()
    {
        return $this->user_phone;
    }

    /**
     * Set user_nip
     *
     * @param string $userNip
     * @return User
     */
    public function setUserNip($userNip)
    {
        $this->user_nip = $userNip;

        return $this;
    }

    /**
     * Get user_nip
     *
     * @return string 
     */
    public function getUserNip()
    {
        return $this->user_nip;
    }

    /**
     * Set user_facture_first_name
     *
     * @param string $userFactureFirstName
     * @return User
     */
    public function setUserFactureFirstName($userFactureFirstName)
    {
        $this->user_facture_first_name = $userFactureFirstName;

        return $this;
    }

    /**
     * Get user_facture_first_name
     *
     * @return string 
     */
    public function getUserFactureFirstName()
    {
        return $this->user_facture_first_name;
    }

    /**
     * Set user_facture_last_name
     *
     * @param string $userFactureLastName
     * @return User
     */
    public function setUserFactureLastName($userFactureLastName)
    {
        $this->user_facture_last_name = $userFactureLastName;

        return $this;
    }

    /**
     * Get user_facture_last_name
     *
     * @return string 
     */
    public function getUserFactureLastName()
    {
        return $this->user_facture_last_name;
    }

    /**
     * Set user_facture_is_company
     *
     * @param boolean $userFactureIsCompany
     * @return User
     */
    public function setUserFactureIsCompany($userFactureIsCompany)
    {
        $this->user_facture_is_company = $userFactureIsCompany;

        return $this;
    }

    /**
     * Get user_facture_is_company
     *
     * @return boolean 
     */
    public function getUserFactureIsCompany()
    {
        return $this->user_facture_is_company;
    }

    /**
     * Set user_facture_street
     *
     * @param string $userFactureStreet
     * @return User
     */
    public function setUserFactureStreet($userFactureStreet)
    {
        $this->user_facture_street = $userFactureStreet;

        return $this;
    }

    /**
     * Get user_facture_street
     *
     * @return string 
     */
    public function getUserFactureStreet()
    {
        return $this->user_facture_street;
    }

    /**
     * Set user_facture_building_nr
     *
     * @param string $userFactureBuildingNr
     * @return User
     */
    public function setUserFactureBuildingNr($userFactureBuildingNr)
    {
        $this->user_facture_building_nr = $userFactureBuildingNr;

        return $this;
    }

    /**
     * Get user_facture_building_nr
     *
     * @return string 
     */
    public function getUserFactureBuildingNr()
    {
        return $this->user_facture_building_nr;
    }

    /**
     * Set user_facture_house_nr
     *
     * @param string $userFactureHouseNr
     * @return User
     */
    public function setUserFactureHouseNr($userFactureHouseNr)
    {
        $this->user_facture_house_nr = $userFactureHouseNr;

        return $this;
    }

    /**
     * Get user_facture_house_nr
     *
     * @return string 
     */
    public function getUserFactureHouseNr()
    {
        return $this->user_facture_house_nr;
    }

    /**
     * Set user_facture_post_code
     *
     * @param string $userFacturePostCode
     * @return User
     */
    public function setUserFacturePostCode($userFacturePostCode)
    {
        $this->user_facture_post_code = $userFacturePostCode;

        return $this;
    }

    /**
     * Get user_facture_post_code
     *
     * @return string 
     */
    public function getUserFacturePostCode()
    {
        return $this->user_facture_post_code;
    }

    /**
     * Set user_facture_city
     *
     * @param string $userFactureCity
     * @return User
     */
    public function setUserFactureCity($userFactureCity)
    {
        $this->user_facture_city = $userFactureCity;

        return $this;
    }

    /**
     * Get user_facture_city
     *
     * @return string 
     */
    public function getUserFactureCity()
    {
        return $this->user_facture_city;
    }

    /**
     * Set user_facture_phone
     *
     * @param string $userFacturePhone
     * @return User
     */
    public function setUserFacturePhone($userFacturePhone)
    {
        $this->user_facture_phone = $userFacturePhone;

        return $this;
    }

    /**
     * Get user_facture_phone
     *
     * @return string 
     */
    public function getUserFacturePhone()
    {
        return $this->user_facture_phone;
    }

    /**
     * Set user_facture_nip
     *
     * @param string $userFactureNip
     * @return User
     */
    public function setUserFactureNip($userFactureNip)
    {
        $this->user_facture_nip = $userFactureNip;

        return $this;
    }

    /**
     * Get user_facture_nip
     *
     * @return string 
     */
    public function getUserFactureNip()
    {
        return $this->user_facture_nip;
    }

    /**
     * Set user_accept_regulations
     *
     * @param boolean $userAcceptRegulations
     * @return User
     */
    public function setUserAcceptRegulations($userAcceptRegulations)
    {
        $this->user_accept_regulations = $userAcceptRegulations;

        return $this;
    }

    /**
     * Get user_accept_regulations
     *
     * @return boolean 
     */
    public function getUserAcceptRegulations()
    {
        return $this->user_accept_regulations;
    }

    /**
     * Set user_accept_newsletter
     *
     * @param boolean $userAcceptNewsletter
     * @return User
     */
    public function setUserAcceptNewsletter($userAcceptNewsletter)
    {
        $this->user_accept_newsletter = $userAcceptNewsletter;

        return $this;
    }

    /**
     * Get user_accept_newsletter
     *
     * @return boolean 
     */
    public function getUserAcceptNewsletter()
    {
        return $this->user_accept_newsletter;
    }

    /**
     * Set user_date_add
     *
     * @param \DateTime $userDateAdd
     * @return User
     */
    public function setUserDateAdd($userDateAdd)
    {
        $this->user_date_add = $userDateAdd;

        return $this;
    }

    /**
     * Get user_date_add
     *
     * @return \DateTime 
     */
    public function getUserDateAdd()
    {
        return $this->user_date_add;
    }

    /**
     * Set user_object_type
     *
     * @param string $userObjectType
     * @return User
     */
    public function setUserObjectType($userObjectType)
    {
        $this->user_object_type = $userObjectType;

        return $this;
    }

    /**
     * Get user_object_type
     *
     * @return string 
     */
    public function getUserObjectType()
    {
        return $this->user_object_type;
    }

    /**
     * Add user_roles
     *
     * @param \Taloc\UserBundle\Entity\Role $userRoles
     * @return User
     */
    public function addUserRole(\Taloc\UserBundle\Entity\Role $userRoles)
    {
        $this->user_roles[] = $userRoles;

        return $this;
    }

    /**
     * Remove user_roles
     *
     * @param \Taloc\UserBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\Taloc\UserBundle\Entity\Role $userRoles)
    {
        $this->user_roles->removeElement($userRoles);
    }

    /**
     * Get user_roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles()
    {
        return $this->user_roles;
    }
}
