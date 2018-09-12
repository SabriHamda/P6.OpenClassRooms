<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 11:52
 */

namespace App\UI\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeAction
{
    private $twig;

    /**
     * HomeAction constructor.
     * @param $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @Route("/", name="frontend-home")
     */
    public function index()
    {
        return new Response($this->twig->render('Frontend/home.html.twig'));
    }
}