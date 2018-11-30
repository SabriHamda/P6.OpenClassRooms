<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Repository;

use App\Domain\Entity\Media;
use App\Domain\Repository\Interfaces\MediaRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MediaRepository extends ServiceEntityRepository implements MediaRepositoryInterface
{

    /**
     * MediaRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Media::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('media')->getQuery()->getResult();

    }

    /**
     * @param Media $media
     * @return bool|void
     */
    public function save(Media $media)
    {
            $this->_em->persist($media);
            $this->_em->flush();
    }

    public function persist(Media $media)
    {
        $this->_em->persist($media);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return null|object
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    /**
     * @param $media
     */
    public function removeMedia($media)
    {
        $this->_em->remove($media);
        $this->_em->flush();
    }

}