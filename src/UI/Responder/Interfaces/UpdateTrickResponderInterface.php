<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Environment;

interface UpdateTrickResponderInterface
{
    /**
     * UpdateTrickResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator,SerializerInterface $serializer);

    /**
     * @param Request $request
     * @param null $viewForm
     * @param $trick
     * @param null $errors
     * @return Response
     */
    public function __invoke(Request $request, $viewForm = null, $trick, $errors = null): Response;

}
