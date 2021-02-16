<?php
/**
 * Created by Sabri Hamda.
 * Date: 23.09.18
 * Time: 14:09.
 */

namespace App\Domain\Repository\Interfaces;

/**
 * Interface UserRepositoryInterface.
 */
/**
 * Interface UserRepositoryInterface
 * @package App\Domain\Repository\Interfaces
 */
/**
 * Interface UserRepositoryInterface
 * @package App\Domain\Repository\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return mixed
     */
    public function findOneBy(array $criteria, array $orderBy = null);

    /**
     * @param $user
     * @return mixed
     */
    public function save($user);

    /**
     * @return mixed
     */
    public function update();

    /**
     * @param $user
     * @return mixed
     */
    public function remove($user);
}
