<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Form\Handler;

use App\Domain\Entity\Trick;
use App\Domain\Entity\Media;
use App\Domain\Repository\Interfaces\CategoryRepositoryInterface;
use App\Domain\Repository\Interfaces\MediaRepositoryInterface;
use App\Mailer\Interfaces\RegistrationMailerInterface;
use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\Services\Interfaces\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddImagesHandler
{
    /**
     * @var string $targetTricksDirectory
     */
    private $targetTricksDirectory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var string $publicTricksDirectory
     */
    private $publicTricksDirectory;

    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * @var MediaRepositoryInterface
     */
    private $mediaRepository;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var RegistrationMailerInterface
     */
    private $registrationMailer;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var array $errors
     */
    private $errors = [];

    /**
     * @var
     */
    private $trick;

    /**
     * @var Security
     */
    private $security;


    /**
     * UpdateTrickHandler constructor.
     * @param $targetTricksDirectory
     * @param $publicTricksDirectory
     * @param ValidatorInterface $validator
     * @param FileUploaderInterface $fileUploader
     * @param EncoderFactoryInterface $encoderFactory
     * @param TrickRepositoryInterface $trickRepository
     * @param MediaRepositoryInterface $mediaRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param RegistrationMailerInterface $registrationMailer
     * @param SessionInterface $session
     * @param Security $security
     */
    public function __construct(
        $targetTricksDirectory,
        $publicTricksDirectory,
        ValidatorInterface $validator,
        FileUploaderInterface $fileUploader,
        EncoderFactoryInterface $encoderFactory,
        TrickRepositoryInterface $trickRepository,
        MediaRepositoryInterface $mediaRepository,
        CategoryRepositoryInterface $categoryRepository,
        RegistrationMailerInterface $registrationMailer,
        SessionInterface $session,
        Security $security
    )
    {
        $this->targetTricksDirectory = $targetTricksDirectory;
        $this->validator = $validator;
        $this->publicTricksDirectory = $publicTricksDirectory;
        $this->fileUploader = $fileUploader;
        $this->encoderFactory = $encoderFactory;
        $this->trickRepository = $trickRepository;
        $this->mediaRepository = $mediaRepository;
        $this->categoryRepository = $categoryRepository;
        $this->registrationMailer = $registrationMailer;
        $this->session = $session;
        $this->security = $security;
    }
    
    /**
     * @param $imagesForm
     * @return bool
     * @throws \Exception
     */
    public function new($imagesForm,$trick)
    {

        // handle the submit
        if ($imagesForm->isSubmitted() && $imagesForm->isValid()) {

            // Get current user
            $user = $this->security->getUser();
            $this->trick = $trick;

            // get medias
            $images = $imagesForm->getData()->image;
            dd($images);

            // Set images
            foreach ($images as $image) {
                $media = new Media($user->getId());
                // get file informations
                $trickImage = new File($image);
                $hashedFileName = md5(uniqid()) . '.' . $image->guessExtension();
                $media->createImageMedia($hashedFileName, $image->guessExtension(), $image->getSize(), $this->publicTricksDirectory . $hashedFileName, $this->trick);
                $this->fileUploader->upload($trickImage, $hashedFileName, $this->targetTricksDirectory);
                $this->mediaRepository->save($media);
            }

            // Validate form
            $errors = $this->validator
                ->validate($imagesForm);

            if (\count($errors) > 0) {
                $this->session->getFlashBag()->add('errors', (string)$errors);
                return false;
            }
            return true;

        }
        return false;

    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return mixed
     */
    public function getTrick()
    {
        return $this->trick;
    }

}