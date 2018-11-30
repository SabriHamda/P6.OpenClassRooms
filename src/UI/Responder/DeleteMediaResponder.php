<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\DeleteMediaResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * This class return response to the remove media action.
 * Class DeleteMediaResponder
 * @package App\UI\Responder
 */
class DeleteMediaResponder implements DeleteMediaResponderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * DeleteMediaResponder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param null $slug
     * @return RedirectResponse
     */
    public function __invoke($request,$slug = null)
    {
        if ($request->isXmlHttpRequest()){

            $response = new Response(json_encode(['status' => 'success']));
            return $response;

        }else{

            if (\is_null($slug)){
                $response = new RedirectResponse($this->urlGenerator->generate('home'));
                return $response;
            }
            $response = new RedirectResponse($this->urlGenerator->generate('update-trick', ['slug' => $slug]));
            return $response;
        }

    }

}