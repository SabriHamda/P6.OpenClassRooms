<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 11:52
 */

namespace App\UI\Action;

use App\Entity\Trick;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeAction extends Controller
{
    /**
     * @var Environment
     */
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
        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->findAll();

        dump($tricks);
        return new Response($this->twig->render('Frontend/home.html.twig'));
    }

}