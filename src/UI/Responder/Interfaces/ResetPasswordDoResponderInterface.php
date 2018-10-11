<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Interface ResetPasswordDoResponderInterface
 * @package App\UI\Responder\Interfaces
 */
interface ResetPasswordDoResponderInterface
{

    /**
     * ResetPasswordDoResponderInterface constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request,$viewForm) :Response;

}