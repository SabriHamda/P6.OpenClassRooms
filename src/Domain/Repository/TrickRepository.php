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
     * @param string $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTrickById(string $id)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $slug
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTrickBySlug(string $slug)
    {
        return $this->createQueryBuilder('u')
            ->where('u.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $trick
     * @return mixed|void
     */
    public function save($trick)
    {
        $this->_em->persist($trick);
        $this->_em->flush();
    }

    /**
     * @param $trick
     * @return mixed|void
     */
    public function persist($trick)
    {
        $this->_em->persist($trick);
    }

    /**
     * @param string $userid
     * @return array
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTricksByUserId(string $userId): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult();

    }

    /**
     * @param $trick
     */
    public function remove($trick)
    {
        $this->_em->remove($trick);
        $this->_em->flush();
    }

}
