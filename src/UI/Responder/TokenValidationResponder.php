<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\TokenValidationResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * TokenValidationResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param null $user
     * @return Response
     */
    public function __invoke($user = null): Response
    {
        $response = new RedirectResponse($this->urlGenerator->generate('home'));
        return $response;
    }
}
