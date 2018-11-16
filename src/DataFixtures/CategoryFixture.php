<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\DataFixtures;

use App\Domain\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends fixture
{

    private $categories = [];

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
   $this->categories = ['Les flips','Les grabs','Les one foot tricks','Les rotations','Les rotations désaxées','Les slides','Old school'];

        // create 20 products! Bam!
        foreach ($this->categories as $name) {
            $category = new Category();
            $category->create($name);

            $manager->persist($category);
        }
        $manager->flush();


    }
}