<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Repository;

use App\Domain\Entity\Comment;
use App\Domain\Repository\Interfaces\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{

    /**
     * CommentRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }
}