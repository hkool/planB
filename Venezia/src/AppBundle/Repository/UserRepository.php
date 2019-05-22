<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 17-4-2019
 * Time: 12:51
 */

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository
{
    public function findByRoles($role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from('OCUserBundle:User', 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }
}
