<?php
/**
 * Created by Sabri Hamda.
 * Date: 23.09.18
 * Time: 14:08.
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('user')->getQuery()->getResult();
    }
}
