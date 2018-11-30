<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Interface TokenValidationResponderInterface
 * @package App\UI\Responder\Interfaces
 */
interface TokenValidationResponderInterface
{
    /**
     * TokenValidationResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator);

    /**
     * @param $user
     * @return mixed
     */
    public function __invoke($user = null);
}