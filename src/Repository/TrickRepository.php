<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 21:07
 */

namespace App\Repository;


use App\Entity\Trick;
use App\Repository\Interfaces\TrickInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class TrickRepository
 * @package App\Repository
 */
class TrickRepository extends ServiceEntityRepository implements TrickInterface
{

    /**
     * TrickRepository constructor.
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
        return parent::findAll();
    }

}