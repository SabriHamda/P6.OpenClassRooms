<?php
/**
 * Created by Sabri Hamda.
 * Date: 27.09.18
 * Time: 13:23
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class RegisterResponder implements RegisterResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RegisterResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
       $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param Interfaces\object|object $viewForm
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, $viewForm): Response
    {
        $response = new Response($this->twig->render(
            'frontend/register.html.twig',
            array('form' => $viewForm)
        ));
        return $response;
    }
}
