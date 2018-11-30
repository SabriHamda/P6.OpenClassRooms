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


use App\Domain\Entity\Media;
use App\Domain\Entity\Trick;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TrickFixture
 * @package App\DataFixtures
 */
class TrickFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * @var
     */
    private $trick;
    /**
     * @var
     */
    private $media;
    /**
     * @var
     */
    private $categories;
    /**
     * @var
     */
    private $category;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TrickFixture constructor.
     * @param CategoryRepository $categoryRepository
     * @param UserRepository $userRepository
     */
    public function __construct(CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $user = $this->userRepository->findOneBy(['username' => 'fixtor']);
        $this->categories = ['Les flips', 'Les grabs', 'Les one foot tricks', 'Les rotations', 'Les rotations désaxées', 'Les slides', 'Old school'];

        for ($i = 1; $i < 17; $i++) {

            // Create tricks
            $this->trick = new Trick();
            $trickName = 'trick_' . $i;
            $trickDescription = file_get_contents('http://loripsum.net/api/5/short/plaintext');
            // Generate category
            $rand_keys = array_rand($this->categories, 2);
            $categoryRndName = $this->categories[$rand_keys[1]];
            $this->category = $this->categoryRepository->getCategoryByName($categoryRndName);

            // Create media
            $this->media = new Media();
            $mediaName = 'image_' . $i;
            $extension = 'jpeg';
            $size = 24659;
            $publicUrl = 'img/default/726x400.jpg';
            $this->media->createImageMedia($mediaName, $extension, $size, $publicUrl, $this->trick);
            $this->trick->create($trickName, $trickDescription, $this->media, $this->category, $user);
            $manager->persist($this->trick);
            $manager->persist($this->media);
            $manager->flush();

        }
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UserFixture::class,
            CategoryFixture::class
        ];
    }
}