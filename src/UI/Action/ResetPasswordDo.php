<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Entity\User;
use App\Form\ResetPasswordDoType;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\ResetPasswordDoResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use Twig\Environment;

/**
 * Class ResetPasswordDo
 * @package App\UI\Action
 */
class ResetPasswordDo
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $redirectRoute;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var FlashBag
     */
    private $flash;

    /**
     * ResetPasswordDo constructor.
     * @param $twig
     */
    public function __construct(Environment $twig, UserRepositoryInterface $userRepository, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, FlashBagInterface $flash)
    {
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->redirectRoute = $urlGenerator;
        $this->validator = $validator;
        $this->flash = $flash;
    }

    /**
     * @Route("reset-password-do/{token}", name="reset-password-do")
     * @param ResetPasswordDoResponderInterface $responder
     * @param Request $request
     * @param $token
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(ResetPasswordDoResponderInterface $responder, Request $request, EncoderFactoryInterface $encoderFactory, $token)
    {
        $user = $this->userRepository->findOneBy(['resetPasswordToken' => $token]);
        if ($user) {
            $form = $this->formFactory->createNamed('resetPasswordForm', ResetPasswordDoType::class)->handleRequest($request);
            $viewForm = $form->createView();
            if ($form->isSubmitted() && $form->isValid()) {
                $encryptedPassword = $encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
                // Use validator to validate form

                $errors = $this->validator->validate($form);

                if (count($errors) > 0) {
                    $viewForm = $form->createView();
                    return $responder($request, $viewForm, $errors);
                } else {
                    $user->updatePassword($encryptedPassword);
                    $this->userRepository->update();
                    $this->flash->add('success', 'Votre mot de passe a bien été modifié, vous pouvez dès à présent vous connecter en cliquant <a href="/login">ici</a>.');
                    return new RedirectResponse($this->redirectRoute->generate('home'));
                }
            }
            return $responder($request, $viewForm);
        } else {
            return new RedirectResponse($this->redirectRoute->generate('home'));

        }


    }
}