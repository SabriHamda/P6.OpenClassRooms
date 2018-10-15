<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use App\Mailer\Interfaces\ResetPasswordMailerInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\Type\ResetPasswordType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ResetPassword
{

    /**
     * @var Environment
     */
    private $twig;

    private $formFactory;

    private $redirectResponse;

    private $flash;

    private $validator;

    /**
     * ResetPassword constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(Environment $twig, FormFactoryInterface $formFactory, FlashBagInterface $flash, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->redirectResponse = $urlGenerator;
        $this->flash = $flash;
        $this->validator = $validator;
    }

    /**
     * @Route("reset-password", name="reset-password")
     * @param Request $request
     * @param ResetPasswordResponderInterface $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(Request $request, ResetPasswordResponderInterface $responder,UserRepositoryInterface $userRepository, ResetPasswordMailerInterface $mailer)
    {
        $form = $this->formFactory->createNamed('resetPasswordForm',ResetPasswordType::class)->handleRequest($request);
        $viewForm = $form->createView();

        if ($form->isSubmitted() && $form->isValid()){

            $user = $userRepository->findOneBy(['email' => $form->getData()->email]);
            $resetPasswordToken = md5(uniqid());

            if ($user){
                // Use validator to validate form
                $errors = $this->validator->validate($form);

                if (count($errors) > 0) {

                    return $responder($request, $viewForm, $errors);

                }else {
                    $user->setResetPasswordToken($resetPasswordToken);
                    $userRepository->update();
                    $mailer->sendTo($user->getUsername(), $resetPasswordToken);
                    $this->flash->add('success', 'Pour confirmer votre email et modifier votre mot de passe, merci de vous rendre dans votre boite mail.');

                    return new RedirectResponse($this->redirectResponse->generate('home'));
                }
            }else{
                $this->flash->add('danger', 'Cet email n\'existe pas, si vous vous étes trompé merci de renouveler votre demande.<br> si vous n\'etes pas encore inscrit vous pouvez le faire par <a href="/register">ici</a>' );

                return new RedirectResponse($this->redirectResponse->generate('reset-password'));
            }
        }
        return $responder($request,$viewForm);
    }
}