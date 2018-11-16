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

}