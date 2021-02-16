<?php
/**
 * Created by Sabri Hamda.
 * Date: 23.09.18
 * Time: 14:08.
 */

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserRepository
 * @package App\Domain\Repository
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('user')->getQuery()->getResult();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return mixed|null|object
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    /**
     * @param string $token
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByValidationToken(string $token)
    {
        return $this->createQueryBuilder('u')
            ->where('u.validationToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $user
     * @return mixed|void
     */
    public function save($user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @return mixed|void
     */
    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param $user
     * @return mixed|void
     */
    public function remove($user)
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }
}
