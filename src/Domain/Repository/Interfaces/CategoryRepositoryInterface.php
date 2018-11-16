<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Repository\Interfaces;

use App\Domain\Entity\Category;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Domain\Repository\Interfaces
 */
interface CategoryRepositoryInterface
{
    /**
     * CategoryRepositoryInterface constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @return array
     */
    public function findAll();

    /**
     * @param Category $category
     * @return bool
     */
    public function save(Category $category): bool;

    /**
     * @param $name
     * @return mixed
     */
    public function getCategoryByName($name);

}