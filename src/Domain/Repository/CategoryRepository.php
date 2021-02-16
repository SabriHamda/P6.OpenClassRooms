<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Repository;

use App\Domain\Entity\Category;
use App\Domain\Repository\Interfaces\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    /**
     * TrickRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->createQueryBuilder('category')->getQuery()->getResult();
    }

    /**
     * @param Category $categoy
     * @return bool
     */
    public function save(Category $categoy): bool
    {
        $this->_em->persist($categoy);
        $this->_em->flush();
        return true;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCategoryByName($name)
    {
        return $this->createQueryBuilder('u')
            ->where('u.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();

    }

}