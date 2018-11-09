<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 21:07.
 */

namespace App\Domain\Repository;

use App\Domain\Entity\Trick;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TrickRepository.
 */
class TrickRepository extends ServiceEntityRepository implements TrickRepositoryInterface
{
    /**
     * TrickRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->createQueryBuilder('tricks')->getQuery()->getResult();
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTrickById(int $id)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
