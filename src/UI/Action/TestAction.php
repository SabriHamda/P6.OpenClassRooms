<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use App\DataFixtures\AppFixtures;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Doctrine\Common\Persistence\ObjectManager;


class TestAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * TestAction constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("test")
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(ObjectManager $manager)
    {
        $content = new AppFixtures();
        $content->load($manager);

        $response = new Response('salut');
        return $response;
    }


}