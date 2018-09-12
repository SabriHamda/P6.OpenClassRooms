<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 11:52
 */

namespace App\Controller\FrontendController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="frontend-home");
     * @Route("/home", name="frontend-home");
     */
    public function index()
    {
        return $this->render('Frontend/home.html.twig');

    }
}