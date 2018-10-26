<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\SecurityResponderInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class SecurityResponder implements SecurityResponderInterface
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * SecurityResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $lastUsername
     * @param $error
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($lastUsername, $error)
    {
        $response = new Response($this->twig->render('frontend/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]));
        return $response;
    }

}