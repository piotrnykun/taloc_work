<?php

namespace Taloc\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class AdminRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        
        try {
            
            $q = $this->getEntityManager()->createQueryBuilder()
                    ->select(array('a', 'r'))
                    ->from('Taloc\UserBundle\Entity\Admin', 'a')
                    ->leftJoin('a.admin_roles', 'r')
                    ->where('a.admin_login = :username')
                    ->setParameter('username', $username)->getQuery(); 
            
        } catch ( \Exception $ex ) { }

        try {
            // The Query::getSingleResult() method throws an exception
            // if there is no record matching the criteria.
            $user = $q->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Użytkownik nie istnieje "%s".',
                $username
            );
            throw new UsernameNotFoundException($message, 0, $e);
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    $class
                )
            );
        }

        return $this->find($user->getId());
    }
    
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class
            || is_subclass_of($class, $this->getEntityName());
    }
}