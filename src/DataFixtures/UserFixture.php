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
use App\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class UserFixture
 * @package App\DataFixtures
 */
class UserFixture extends Fixture
{
    /**
     * @var $user
     */
    private $user;

    /**
     * @var $media
     */
    private $media;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * UserFixture constructor.
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        // Create avatar
        $publicDefaultDirectory = 'img/default/default-user-avatar.png';
        $image = 'default-user-avatar.png';
        $this->media = new Media();
        $this->media->createImageMedia($image, 'png', 2340, $publicDefaultDirectory, null);
        $manager->persist($this->media);

        // Create user
        $this->user = new User();
        $username = 'fixtor';
        $password = 'password';
        $email = 'fixture@fixture.com';
        $encryptedPassword = $this->encoderFactory->getEncoder(User::class)->encodePassword($password, null);
        $this->user->create($username, $email, $encryptedPassword, $this->media);
        $manager->persist($this->user);
        $this->user->validate();

        $manager->flush();
    }
}
