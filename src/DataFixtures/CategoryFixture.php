<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Domain\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CategoryFixture
 * @package App\DataFixtures
 */
class CategoryFixture extends fixture implements DependentFixtureInterface
{

    /**
     * @var array
     */
    private $categories = [];

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->categories = ['Les flips', 'Les grabs', 'Les one foot tricks', 'Les rotations', 'Les rotations désaxées', 'Les slides', 'Old school'];

        // Create categories
        foreach ($this->categories as $name) {
            $category = new Category();
            $category->create($name);

            $manager->persist($category);
        }
        $manager->flush();


    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixture::class
        ];
    }
}
