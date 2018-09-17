<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 11:52
 */

namespace App\UI\Action;

use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var trickRepository
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
     */
    public function index()
    {
        $tricks = $this->trickRepository->findAll();

        return new Response($this->twig->render('Frontend/home.html.twig', ['tricks' => $tricks]));
    }

}
