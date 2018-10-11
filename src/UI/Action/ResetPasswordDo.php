<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Form\ResetPasswordDoType;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\ResetPasswordDoResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ResetPasswordDo
{

    /**
     * @var Environment
     */
    private $twig;

    private $userRepository;

    private $formFactory;

    private $redirectRoute;

    /**
     * ResetPasswordDo constructor.
     * @param $twig
     */
    public function __construct(Environment $twig,UserRepositoryInterface $userRepository,FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->redirectRoute = $urlGenerator;
    }

    /**
     * @Route("reset-password-do/{token}", name="reset-password-do")
     * @param ResetPasswordDoResponderInterface $responder
     * @param Request $request
     * @param $token
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(ResetPasswordDoResponderInterface $responder,Request $request,$token)
    {
        $user = $this->userRepository->findOneBy(['resetPasswordToken'=> $token]);
        if ($user){
            $form = $this->formFactory->createNamed('resetPasswordForm',ResetPasswordDoType::class)->handleRequest($request);
            $viewForm = $form->createView();
            return $responder($request,$viewForm);
        }else{
            return new RedirectResponse($this->redirectRoute->generate('home'));

        }

    }
}