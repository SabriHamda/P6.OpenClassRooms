<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;


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
     */
    public function __construct(Environment $twig);

    /**
     * @param $user
     * @param $flash
     * @return mixed
     */
    public function __invoke($user, $flash);
}