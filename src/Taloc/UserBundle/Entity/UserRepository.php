<?php

namespace Taloc\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        
        try {
            
            $q = $this->getEntityManager()->createQueryBuilder()
                    ->select(array('u', 'r'))
                    ->from('Taloc\UserBundle\Entity\User', 'u')
                    ->leftJoin('u.user_roles', 'r')
                    ->where('u.user_email = :username')
                    ->setParameter('username', $username)->getQuery(); 
            
                //dd($q->getSingleResult());exit();
                //dd($q);exit();
        } catch ( \Exception $ex ) {  }

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
    
    
    public function countAll() {
        try {
            $query = ' SELECT
                            COUNT(u) as ilosc
                       FROM 
                            Taloc\UserBundle\Entity\User u 
                      ' ;
            
            $query = $this->getEntityManager()->createQuery($query);
            $result = $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if ( !$result ) {
                throw new \Exception();
            }
            
            return $result['ilosc'];
            
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    public function countAllFiltered($search = '') {
         try {
            $query = ' SELECT
                            COUNT(u) as ilosc
                       FROM 
                            Taloc\UserBundle\Entity\User u 
                       WHERE 
                            u.user_id LIKE :search OR u.user_email LIKE :search OR u.user_facebook_code LIKE :search OR u.user_sex LIKE :search OR u.user_type LIKE :search OR u.user_first_name LIKE :search OR u.user_last_name LIKE :search OR u.user_street LIKE :search
                      ' ;
            
            $query = $this->getEntityManager()->createQuery($query)->setParameter('search', $search);
            $result = $query->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            if ( !$result ) {
                throw new \Exception();
            }
            
            return $result['ilosc'];
            
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    public function getAll($search = false, $offset = 0 , $limit = 20) {
        try {
            
            $where = ' 1 = :search ';
            
            if (!$offset) {
                $offset = 0;
            }
            
            if (!$limit) {
                $limit = 20;
            }

            $searchActive = false;
            
            if ( $search ) {
                $where = ' u.user_id LIKE :search OR u.user_email LIKE :search OR u.user_facebook_code LIKE :search OR u.user_sex LIKE :search OR u.user_type LIKE :search OR u.user_first_name LIKE :search OR u.user_last_name LIKE :search OR u.user_street LIKE :search ';
                $searchActive = true;
                $search = '%'.$search.'%';
            } else {
                $search = 1;
            }
            
            $order = '';
            if ( isset($_POST['order']) && (isset($_POST['order'][0]['column'])) ) {
                
                switch ( $_POST['order'][0]['column'] ) {
                    case 0:
                        $order = ' ORDER BY u.user_id ';
                        break;
                    case 1:
                        $order = ' ORDER BY u.user_email ';
                        break;
                    case 2:
                        $order = ' ORDER BY u.user_first_name ';
                        break;
                    case 3:
                        $order = ' ORDER BY u.user_last_name ';
                        break;
                    case 4:
                        $order = ' ORDER BY u.user_is_company ';
                        break;
                    case 5:
                        $order = ' ORDER BY u.user_facebook_code ';
                        break;
                    case 6:
                        $order = ' ORDER BY u.user_type ';
                        break;
                    case 7:
                        $order = ' ORDER BY u.user_status ';
                        break;
                    case 8:
                        $order = ' ORDER BY u.user_sex ';
                        break;
                    default:
                        $order = ' ORDER BY u.user_id ';
                        break;
                }
                
                $order.= $_POST['order'][0]['dir'];
                
            }
            
            $query = ' SELECT
                            u,r
                       FROM 
                            Taloc\UserBundle\Entity\User u 
                       LEFT JOIN 
                            u.user_roles r
                       WHERE
                            '.$where.'
                       '.$order.' ';
            
            $query = $this->getEntityManager()->createQuery($query)
                    ->setParameter('search', $search)
                    ->setMaxResults($limit)
                    ->setFirstResult($offset);
            $result = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            
            $response = array();

            if ( count($result) > 0 ) {
                
                foreach ( $result as $key => $value ) {
                    
                    $response[$key][0] = $value['user_id'];
                    $response[$key][1] = $value['user_email'];
                    $response[$key][2] = $value['user_first_name'];
                    $response[$key][3] = $value['user_last_name'];
                    $response[$key][4] = ( $value['user_is_company'] ? 'Tak' : 'NIE' );
                    $response[$key][5] = ( $value['user_facebook_code'] ? 'Facebook' : 'Sklep' );
                    $response[$key][6] = $value['user_type'];
                    $response[$key][7] = ( $value['user_status'] ? 'Aktywne': 'Nieaktywne' );
                    $response[$key][8] = $value['user_sex'];
                }  

            } 
            
            $total_filtered = count($response);

            if ( $searchActive )  {
                $total = $this->countAllFiltered($search); 
            } else {
                $total = $this->countAll(); 
            }
            
            $return_data = array( 'data' => $response, 'recordsFiltered' => $total_filtered, 'iTotalDisplayRecords' => $total , 'recordsTotal' => $total );
            return $return_data;
            
        } catch (\Exception $ex) {
            return array();
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}