<?php
/**
 * Created by Sabri Hamda.
 * Date: 19.09.18
 * Time: 16:40.
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class HomeResponder.
 */
class HomeResponder implements HomeResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param array   $trick
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, array $tricks): Response
    {
        $response = new Response($this->twig->render('frontend/home.html.twig', ['tricks' => $tricks]));
        $response->setCache([
            'public' => true,
            'etag' => md5($request->getBasePath()),
            'max_age' => 300,
            's_maxage' => 600,
            'last_modified' => new \DateTime(),
        ]);

        return $response;
    }
}
