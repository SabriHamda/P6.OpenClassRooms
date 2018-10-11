<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\UI\Responder\ResetPasswordDoResponder;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ResetPasswordDo
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ResetPasswordDo constructor.
     * @param $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("reset-password-do/{token}", name="reset-password-do")
     * @param ResetPasswordDoResponder $responder
     * @param $token
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ResetPasswordDoResponder $responder)
    {
        return $responder();
    }
}