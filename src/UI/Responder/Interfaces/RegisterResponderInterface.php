<?php
/**
 * Created by Sabri Hamda.
 * Date: 27.09.18
 * Time: 13:19.
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface RegisterResponderInterface
{
    /**
     * RegisterResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param Request $request
     * @param $viewForm
     *
     * @return Response
     */
    public function __invoke(Request $request, $viewForm): Response;
}
