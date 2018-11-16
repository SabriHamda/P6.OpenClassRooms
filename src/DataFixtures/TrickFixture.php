<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\DataFixtures;

use App\Domain\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixture extends Fixture
{

    private $categories = [];

    public function __construct()
    {
        $this->categories = ['Les flips','Les grabs','Les one foot tricks','Les rotations','Les rotations désaxées','Les slides','Old school'];

    }


    public function load(ObjectManager $manager)
    {
        // Get current user
        $user = $this->security->getUser();
        $this->trick = new Trick();

        // Set category
        $categoryName = $this->categories[array_rand($this->categories)];

        // get medias
        $images = $form->getData()->image;
        $videos = $form->getData()->videos;

        // Set videos
        foreach ($videos as $video) {
            $media = new Media();
            $media->createVideoMedia($this->trick, $video);
            $this->mediaRepository->persist($media);
        }

        // Set images
        foreach ($images as $image) {
            $media = new Media();
            // get file informations
            $trickImage = new File($image);
            $hashedFileName = md5(uniqid()) . '.' . $image->guessExtension();
            $media->createImageMedia($hashedFileName, $image->guessExtension(), $image->getSize(), $this->publicTricksDirectory . $hashedFileName, $this->trick);
            $this->fileUploader->upload($trickImage, $hashedFileName, $this->targetTricksDirectory);
            $this->mediaRepository->persist($media);

            // Create a new trick
            $this->trick->create(
                $form->getData()->name,
                $form->getData()->description,
                $media,
                $category,
                $user
            );

        }

        // Trick validator to validate form
        $errors = $this->validator
            ->validate($this->trick);
        if (\count($errors) > 0) {
            $this->session->getFlashBag()->add('errors', (string)$errors);
            return false;
        }
        $this->trickRepository->save($this->trick);
        return true;


    }
}