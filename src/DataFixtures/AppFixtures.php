<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 22:36.
 */

namespace App\DataFixtures;

use App\Domain\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures.
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; ++$i) {
            $trick = new Trick();
            $trick->setCategoryId(mt_rand(10, 100));
            $trick->setCommentId(mt_rand(10, 100));
            $trick->setName('Trick '.$i);
            $trick->setImage('https://via.placeholder.com/726x400');
            $trick->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra convallis justo, in convallis dui efficitur at. Morbi non mauris nec dui condimentum pulvinar eget ut metus. Duis mollis bibendum pretium. Quisque egestas elementum fermentum. Quisque magna nunc, pellentesque sit amet ex at, cursus imperdiet sapien. Curabitur vel tempus dolor. Aliquam non tincidunt ex.');
            $trick->setCreatedAt($trick->getCreatedAt());
            $trick->setUpdatedAt($trick->getUpdatedAt());
            $manager->persist($trick);
        }

        $manager->flush();
    }
}
