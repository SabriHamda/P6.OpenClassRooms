<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\ViewTrickResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

/**
 * Class ViewTrick
 * @package App\UI\Action
 */
class ViewTrickAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * ViewTrick constructor.
     * @param Environment $twig
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(Environment $twig, TrickRepositoryInterface $trickRepository)
    {
        $this->twig = $twig;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @Route("view-trick/{slug}")
     * @param Request $request
     * @param ViewTrickResponderInterface $responder
     * @param $slug
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request,ViewTrickResponderInterface $responder, $slug)
    {
        $trickRepository = $this->trickRepository;
        $trick = $trickRepository->getTrickBySlug($slug);
        return $responder($trick);
    }

}