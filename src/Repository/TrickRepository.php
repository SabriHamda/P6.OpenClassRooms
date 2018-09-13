<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 21:07
 */

namespace App\Repository;


use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TrickRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trick::class);
    }

}