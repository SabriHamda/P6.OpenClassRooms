<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ResetPasswordResponder implements ResetPasswordResponderInterface
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResetTokenResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param $viewForm
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, $viewForm): Response
    {
        $response = new Response($this->twig->render('frontend/resetPassword.html.twig',['resetPasswordForm'=> $viewForm]));
        return $response;
    }
}