<?php

namespace Taloc\AppBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tc_role")
 * @ORM\Entity()
 */
class Role implements RoleInterface
{
    /**
     * @ORM\Column(name="role_id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $role_id;

    /**
     * @ORM\Column(name="role_name", type="string", length=30)
     */
    private $role_name;

    /**
     * @ORM\Column(name="role_value", type="string", length=20, unique=true)
     */
    private $role_value;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="user_roles")
     */
    private $role_users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role_value;
    }

}