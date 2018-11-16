<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Form\Handler;

use App\Domain\Entity\User;
use App\Domain\Entity\Media;
use App\Mailer\Interfaces\RegistrationMailerInterface;
use App\Domain\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class UserHandler
 * @package App\UI\Form\Handler
 */
class UserHandler
{

    /**
     * @var string $targetDirectory
     */
    private $targetDirectory;

    private $targetDefaultDirectory;

    private $publicDefaultDirectory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var string $publicAvatarDirectory
     */
    private $publicAvatarDirectory;

    /**
     * @var FileUploaderInterface
     */
    private $fileUploader;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    private $registrationMailer;

    private $session;

    /**
     * @var array $errors
     */
    private $errors = [];


    /**
     * UserHandler constructor.
     * @param $targetDirectory
     * @param $publicAvatarDirectory
     * @param ValidatorInterface $validator
     * @param FileUploaderInterface $fileUploader
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserRepositoryInterface $userRepository
     * @param RegistrationMailerInterface $registrationMailer
     * @param SessionInterface $session
     */
    public function __construct(
        $targetDirectory,
        $publicAvatarDirectory,
        $targetDefaultDirectory,
        $publicDefaultDirectory,
        ValidatorInterface $validator,
        FileUploaderInterface $fileUploader,
        EncoderFactoryInterface $encoderFactory,
        UserRepositoryInterface $userRepository,
    RegistrationMailerInterface $registrationMailer,
    SessionInterface $session
    )
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetDefaultDirectory = $targetDefaultDirectory;
        $this->publicDefaultDirectory = $publicDefaultDirectory;
        $this->validator = $validator;
        $this->publicAvatarDirectory = $publicAvatarDirectory;
        $this->fileUploader = $fileUploader;
        $this->encoderFactory = $encoderFactory;
        $this->userRepository = $userRepository;
        $this->registrationMailer = $registrationMailer;
        $this->session = $session;
    }

    /**
     * @param $form
     * @return bool
     * @throws \Exception
     */
    public function new($form)
    {

        // 2) handle the submit (will only happen on POST)
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->getData()->image;
            $defaultImage = new File($this->targetDefaultDirectory . '/default-user-avatar.png');
            $media = new Media();
            //is user choose to upload an image
            if ($image) {
                $avatar = new File($form->getData()->image);
                $hashedFileName = md5(uniqid()) . '.' . $image->guessExtension();
                $media->createImageMedia($hashedFileName, $image->guessExtension(), $image->getSize(), $this->publicAvatarDirectory . $hashedFileName,null);
                //Upload file in directory
                $this->fileUploader->upload($avatar, $hashedFileName, $this->targetDirectory);
                //if user don't choose an image
            } else {
                $image = 'default-user-avatar.png';
                $media->createImageMedia($image, $defaultImage->guessExtension(), $defaultImage->getSize(), $this->publicDefaultDirectory . $image,null);
            }
            $encryptedPassword = $this->encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
            $user = new User();
            $user->create(
                $form->getData()->username,
                $form->getData()->email,
                $encryptedPassword,
                $media
            );

            // Use validator to validate form
            $errors = $this->validator
                ->validate($user);
            if (\count($errors) > 0) {
                $this->session->getFlashBag()->add('errors', (string) $errors);
                return false;
            }
                // save the User!
                $this->userRepository->save($user);
                // send an email with token
                $this->registrationMailer->sendTo($form->getData()->email, $form->getData()->username,  $user->getValidationToken());
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

}
