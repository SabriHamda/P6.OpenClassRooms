<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

interface DeleteMediaResponderInterface
{
    /**
     * DeleteMediaResponderInterface constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator);

    /**
     * @param null $slug
     * @return mixed
     */
    public function __invoke($request, $slug = null);



}