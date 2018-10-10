<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use App\Repository\Interfaces\UserRepositoryInterface;
use App\UI\Responder\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Form\FormFactoryInterface;
use App\Form\ResetPasswordType;

class ResetPassword
{

    /**
     * @var Environment
     */
    private $twig;

    private $formFactory;

    /**
     * ResetPassword constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(Environment $twig, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("reset-password", name="reset-password")
     * @param Request $request
     * @param ResetPasswordResponderInterface $responder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, ResetPasswordResponderInterface $responder,UserRepositoryInterface $userRepository)
    {
        $form = $this->formFactory->createNamed('resetPasswordForm',ResetPasswordType::class)->handleRequest($request);
        $viewForm = $form->createView();

        if ($form->isSubmitted() & $form->isValid()){
            $userEmail = $userRepository->findOneBy(['email' => $form->getData()->email]);

            if ($userEmail){
                $moi = 'trouvé';
            }else{
                $moi = 'non trouvé';
            }
        }
        return $responder($request,$viewForm);
    }
}