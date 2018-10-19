<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Entity\User;
use App\Form\Type\ResetPasswordDoType;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\ResetPasswordDoResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var SessionInterface
     */
    private $session;

    /**
     * ResetPasswordDo constructor.
     * @param Environment $twig
     * @param UserRepositoryInterface $userRepository
     * @param FormFactoryInterface $formFactory
     * @param UrlGeneratorInterface $urlGenerator
     * @param ValidatorInterface $validator
     * @param SessionInterface $session
     */
    public function __construct(Environment $twig, UserRepositoryInterface $userRepository, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, SessionInterface $session)
    {
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->redirectRoute = $urlGenerator;
        $this->validator = $validator;
        $this->session = $session;
    }

    /**
     * @Route("reset-password-do/{token}", name="reset-password-do")
     * @param ResetPasswordDoResponderInterface $responder
     * @param Request $request
     * @param EncoderFactoryInterface $encoderFactory
     * @param $token
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(ResetPasswordDoResponderInterface $responder, Request $request, EncoderFactoryInterface $encoderFactory, $token)
    {
        $user = $this->userRepository->findOneBy(['resetPasswordToken' => $token]);
        if ($user) {
            $form = $this->formFactory->createNamed('resetPasswordDoForm', ResetPasswordDoType::class)->handleRequest($request);
            $viewForm = $form->createView();
            if ($form->isSubmitted() && $form->isValid()) {
                $encryptedPassword = $encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
                // Use validator to validate form

                $errors = $this->validator->validate($form);

                if (count($errors) > 0) {
                    $viewForm = $form->createView();
                    foreach($errors as $error){
                        $this->session->getFlashBag()->add('errors', $error);
                    }


                    return $responder($request, $viewForm);
                    dd($this->session->getFlashBag());
                } else {
                    $user->updatePassword($encryptedPassword);
                    $this->userRepository->update();
                    $this->session->getFlashBag()->add('success', 'Votre mot de passe a bien été modifié, vous pouvez dès à présent vous connecter en cliquant <a href="/login">ici</a>.');
                    return new RedirectResponse($this->redirectRoute->generate('home'));
                }
            }
            return $responder($request, $viewForm);
        } else {
            return new RedirectResponse($this->redirectRoute->generate('home'));

        }


    }
}