<?php
/**
 * Created by Sabri Hamda.
 * Date: 27.09.18
 * Time: 13:23.
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;

class RegisterResponder implements RegisterResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * RegisterResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param Request|null $request
     * @param null $viewForm
     * @param null $errors
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, $viewForm = null, $errors = null): Response
    {
        $redirect = $request->attributes->get('redirect');
        if($redirect){
           $response = new RedirectResponse($this->urlGenerator->generate($redirect));
        }else{
            $response = new Response($this->twig->render(
                'frontend/register.html.twig',
                array('form' => $viewForm, 'errors' => $errors)
            ));
        }

        return $response;
    }
}
