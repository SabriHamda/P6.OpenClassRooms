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
     * @param int $id
     * @return mixed
     */
    public function getTrickById(int $id);

    /**
     * @param $trick
     * @return mixed|void
     */
    public function save($trick);
}
