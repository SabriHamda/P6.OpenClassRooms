<?php
/**
 * Created by Sabri Hamda.
 * Date: 25.09.18
 * Time: 14:50.
 */

namespace App\UI\Action;

use App\Entity\Media;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Mailer\RegistrationMailer;
use App\Services\Interfaces\FileUploaderInterface;
use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RegisterAction
 * @package App\UI\Action
 */
class RegisterAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formfactory;

    /**
     * @var FlashBagInterface
     */
    private $flash;

    /**
     * @var RedirectResponse
     */
    private $redirectResponse;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $configPath;

    /**
     * @var Validation
     */
    private $validator;

    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * @var string
     */
    private $publicAvatarDirectory;


    /**
     * RegisterAction constructor.
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     * @param FormFactoryInterface $formFactory
     * @param FlashBagInterface $flash
     * @param UrlGeneratorInterface $generateUrl
     * @param string $configPath
     * @param ValidatorInterface $validator
     * @param $targetDirectory
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer, FormFactoryInterface $formFactory, FlashBagInterface $flash, UrlGeneratorInterface $generateUrl, string $configPath, ValidatorInterface $validator, $targetDirectory, $publicAvatarDirectory)
    {
        $this->twig = $twig;
        $this->formfactory = $formFactory;
        $this->flash = $flash;
        $this->redirectResponse = $generateUrl;
        $this->mailer = $mailer;
        $this->configPath = $configPath;
        $this->validator = $validator;
        $this->targetDirectory = $targetDirectory;
        $this->publicAvatarDirectory = $publicAvatarDirectory;
    }

    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @param EncoderFactoryInterface $encoderFactory
     * @param UserRepositoryInterface $userRepository
     * @param RegisterResponderInterface $responder
     * @param FileUploaderInterface $fileUploader
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function __invoke(Request $request, EncoderFactoryInterface $encoderFactory, UserRepositoryInterface $userRepository, RegisterResponderInterface $responder, FileUploaderInterface $fileUploader)
    {
        // 1) build the form
        $user = new User();
        $form = $this->formfactory->create(UserType::class)->handleRequest($request);

        // 2) handle the submit (will only happen on POST)
        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->getData()->image;
            $defaultImage = new File($this->targetDirectory . '/default-user-avatar.png');
            $media = new Media();
            if ($image) {
                $avatar = new File($form->getData()->image);
                $hashedFileName = md5(uniqid()) . '.' . $image->guessExtension();
                $media->create($hashedFileName, $image->guessExtension(), $image->getSize(), $this->publicAvatarDirectory . $hashedFileName);
                //Upload file in directory
                $fileUploader->upload($avatar, $hashedFileName);
            }else {
                $image = 'default-user-avatar.png';
                $media->create($image, $defaultImage->guessExtension(), $defaultImage->getSize(), $this->publicAvatarDirectory . $image);
            }
            $encryptedPassword = $encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
            $user->create(
                $form->getData()->username,
                $form->getData()->email,
                $encryptedPassword,
                $media
            );

            // Use validator to validate form
            $errors = $this->validator
                ->validate($user);
            if (count($errors) > 0) {
                $viewForm = $form->createView();
                return $responder($request, $viewForm, $errors);
            } else {

                // 4) save the User!
                $userRepository->save($user);

                // 5) send an email with token
                $mailer = new RegistrationMailer($this->mailer, $this->twig);
                $mailer->sendTo($form->getData()->username, $user->getValidationToken());

                // 6) redirect to home page with success message
                $this->flash->add('success', 'Votre enregistrement a bien été pris en compte, pour valider votre inscription, merci de vous rendre dans votre boite mail.');

                return new RedirectResponse($this->redirectResponse->generate('frontend-home'));
            }

        }

        $viewForm = $form->createView();
        return $responder($request, $viewForm);
    }
}
