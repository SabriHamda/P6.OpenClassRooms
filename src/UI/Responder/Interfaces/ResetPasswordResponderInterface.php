<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Interface ResetTokenResponderInterface
 * @package App\UI\Responder\Interfaces
 */
interface ResetPasswordResponderInterface
{
    /**
     * ResetTokenResponderInterface constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param Request $request
     * @param $viewForm
     * @param $errors
     * @return Response
     */
    public function __invoke(Request $request, $viewForm,$errors = null) :Response;

}