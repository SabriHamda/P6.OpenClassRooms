<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddTrickResponderInterface
{
    /**
     * AddTrickResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param Request $request
     * @param null $viewForm
     * @param null $errors
     * @return Response
     */
    public function __invoke(Request $request, $viewForm = null, $errors = null): Response;

}