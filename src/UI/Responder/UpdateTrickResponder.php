<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;

use App\Services\Slugify;
use App\UI\Responder\Interfaces\UpdateTrickResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateTrickResponder implements UpdateTrickResponderInterface
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * UpdateTrickResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator, SerializerInterface $serializer)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param null $viewForm
     * @param null $viewImagesForm
     * @param $trick
     * @param null $errors
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, $viewForm = null, $trick, $errors = null): Response
    {
        if ($request->isXmlHttpRequest()) {
                $slug = $request->get('slug');
                $serializedErrors = $this->serializer->serialize($errors,'json');
                $response = new Response(json_encode(['slug' => $slug, 'error' => $serializedErrors]));
                return $response;
        } else {
            if ($request->attributes->get('redirect')) {
                $newTrickName =  $request->get('update_trick')['name'];
                $slug = Slugify::slugify($newTrickName);
                $path = $this->urlGenerator->generate('view-trick', ['slug' => $slug]);
                $response = new RedirectResponse($path);
            } else {
                $response = new Response($this->twig->render(
                    'frontend/updateTrick.html.twig',
                    array('form' => $viewForm, 'trick' => $trick, 'errors' => $errors)
                ));
            }
            return $response;
        }


    }

}
