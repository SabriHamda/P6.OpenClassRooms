<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 22:36
 */

namespace App\DataFixtures;


use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $trick = new Trick();
            $trick->setCategoryId(mt_rand(10, 100));
            $trick->setCommentId(mt_rand(10, 100));
            $trick->setName('Trick '.$i);
            $trick->setImage('https://via.placeholder.com/286x180');
            $trick->setDescription('Some quick example text to build on the card title and make up the bulk of the card\'s content.');
            $trick->setCreatedAt($trick->getCreatedAt());
            $trick->setUpdatedAt($trick->getUpdatedAt());
            $manager->persist($trick);
        }

        $manager->flush();
    }
}