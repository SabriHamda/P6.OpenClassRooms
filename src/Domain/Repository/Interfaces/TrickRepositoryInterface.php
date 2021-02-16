<?php
/**
 * Created by Sabri Hamda.
 * Date: 15.09.18
 * Time: 16:07.
 */

namespace App\Domain\Repository\Interfaces;

/**
 * Interface TrickRepositoryInterface.
 */
interface TrickRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param string $id
     * @return mixed
     */
    public function getTrickById(string $id);

    /**
     * @param string $slug
     * @return mixed
     */
    public function getTrickBySlug(string $slug);

    /**
     * @param $trick
     * @return mixed|void
     */
    public function save($trick);

    /**
     * @param $trick
     * @return mixed|void
     */
    public function persist($trick);

    /**
     * @param string $userId
     * @return array
     */
    public function getTricksByUserId(string $userId) :array ;

    /**
     * @param $trick
     * @return mixed
     */
    public function remove($trick);
}
