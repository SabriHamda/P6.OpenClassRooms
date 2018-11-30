<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Responder;


use App\UI\Responder\Interfaces\DeleteTrickResponderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteTrickResponder implements DeleteTrickResponderInterface
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $generator;


    /**
     * DeleteTrickResponder constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(Environment $twig, UrlGeneratorInterface $generator)
    {
        $this->twig = $twig;
        $this->generator = $generator;
    }

    public function __invoke(Request $request) : RedirectResponse
    {
        $response = new RedirectResponse($this->generator->generate('home'));
        return $response;
    }
}
