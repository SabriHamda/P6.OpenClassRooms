<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;


use Twig\Environment;

interface LoginResponderInterface
{

    /**
     * SecurityResponderInterface constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @param $lastUsername
     * @param $error
     * @return mixed
     */
    public function __invoke($lastUsername, $error);
}