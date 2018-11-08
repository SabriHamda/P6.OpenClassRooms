<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\ViewTrickResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ViewTrickResponder implements ViewTrickResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ViewTrickResponder constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $trick
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($trick) :Response
    {
        $response = new Response($this->twig->render('frontend/view-trick.html.twig',['trick'=>$trick]));
        return $response;

    }
}