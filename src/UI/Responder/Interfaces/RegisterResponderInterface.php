<?php
/**
 * Created by Sabri Hamda.
 * Date: 27.09.18
 * Time: 13:19.
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface RegisterResponderInterface
{
    /**
     * RegisterResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param Request|null $request
     * @param null $viewForm
     * @param null $errors
     * @param null $redirectedAction
     * @return Response
     */
    public function __invoke(Request $request, $viewForm = null, $errors = null): Response;
}
