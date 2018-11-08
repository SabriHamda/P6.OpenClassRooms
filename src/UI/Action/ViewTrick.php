<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ViewTrick
 * @package App\UI\Action
 */
class ViewTrick
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * ViewTrick constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("view-trick/{id}")
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index($id)
    {
        $response = new Response($this->twig->render('frontend/view-trick.html.twig'));
        return $response;
    }

}