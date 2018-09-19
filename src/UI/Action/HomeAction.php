<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 11:52
 */

namespace App\UI\Action;

use App\Repository\TrickRepository;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class HomeAction
 * @package App\UI\Action
 */
class HomeAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var TrickRepository
     */
    private $trickRepository;

    /**
     * HomeAction constructor.
     * @param $twig
     */
    public function __construct(Environment $twig, TrickRepository $trickRepository)
    {
        $this->twig = $twig;
        $this->trickRepository = $trickRepository;
    }


    /**
     * @Route("/", name="frontend-home")
     * @throws
     * @return Response
     */
    public function __invoke(Request $request, HomeResponderInterface $responder)
    {
        $tricks = $this->trickRepository->findAll();

        return $responder($request, $tricks);

    }



}
