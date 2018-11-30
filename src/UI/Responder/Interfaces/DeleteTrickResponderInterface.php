<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Responder\Interfaces;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface DeleteTrickResponderInterface
{
    /**
     * DeleteTrickResponderInterface constructor.
     * @param Environment $twig
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(Environment $twig,UrlGeneratorInterface $generator);

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request) : RedirectResponse;


}
