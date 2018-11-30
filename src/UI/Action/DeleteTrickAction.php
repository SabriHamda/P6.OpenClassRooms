<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Action;


use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteTrickResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTrickAction
{
    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * DeleteTrickAction constructor.
     * @param TrickRepositoryInterface $trickRepository
     */
    public function __construct(TrickRepositoryInterface $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }


    /**
     * @Route("delete-trick/{slug}", name = "delete-trick")
     * @param Request $request
     * @param DeleteTrickResponderInterface $responder
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function __invoke(Request $request,DeleteTrickResponderInterface $responder, $slug)
    {
        $trick = $this->trickRepository->getTrickBySlug($slug);
        $this->trickRepository->remove($trick);
        $response = $responder($request);
        return $response;

    }

}