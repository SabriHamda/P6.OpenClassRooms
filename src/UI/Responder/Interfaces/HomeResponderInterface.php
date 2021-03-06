<?php
/**
 * Created by Sabri Hamda.
 * Date: 19.09.18
 * Time: 16:40.
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Interface HomeResponderInterface.
 */
interface HomeResponderInterface
{
    /**
     * HomeResponderInterface constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param Request $request
     * @param array $tricks
     * @return Response
     */
    public function __invoke(Request $request, array $tricks): Response;
}
