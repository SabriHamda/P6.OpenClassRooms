<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\TokenValidationResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


/**
 * Class TokenValidationResponder
 * @package App\UI\Responder
 */
class TokenValidationResponder implements TokenValidationResponderInterface
{

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * TokenValidationResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $user
     * @param $flash
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($user, $flash) :Response
    {
        $response = new Response($this->twig->render('frontend/registerTokenValidation.html.twig',['user'=> $user,'message' => $flash, 'button' => true]));

        return $response;
    }
}
