<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Repository\Interfaces;


use App\Domain\Entity\Media;

interface MediaRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();


    /**
     * @param Media $media
     * @return mixed
     */
    public function save(Media $media);

    /**
     * @param Media $media
     * @return mixed
     */
    public function persist(Media $media);

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return mixed
     */
    public function findOneBy(array $criteria, array $orderBy = null);

    /**
     * @param $media
     * @return mixed
     */
    public function removeMedia($media);


}