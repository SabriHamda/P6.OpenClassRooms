<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\ResetPasswordDoResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ResetPasswordDoResponder implements ResetPasswordDoResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResetPasswordDoResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function __invoke(Request $request,$viewForm, $errors = null) :Response
    {
        $response = new Response($this->twig->render('frontend/resetPasswordDo.html.twig',['resetPasswordDoForm'=>$viewForm,'errors'=>$errors]));
        return $response;
    }
}