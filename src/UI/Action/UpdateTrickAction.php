<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Domain\Repository\Interfaces\TrickRepositoryInterface;
use App\UI\Form\Handler\AddImagesHandler;
use App\UI\Form\Handler\UpdateTrickHandler;
use App\UI\Form\Type\UpdateTrickType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\UI\Responder\Interfaces\UpdateTrickResponderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateTrickAction
{

    /**
     * @var UpdateTrickHandler
     */
    private $handler;

    /**
     * @var AddImagesHandler
     */
    private $imagesHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FlashBagInterface
     */
    private $flash;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TrickRepositoryInterface
     */
    private $trickRepository;

    /**
     * UpdateTrickAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param UpdateTrickHandler $handler
     * @param FlashBagInterface $flash
     * @param SessionInterface $session
     */
    public function __construct(FormFactoryInterface $formFactory, UpdateTrickHandler $handler, AddImagesHandler $imagesHandler, FlashBagInterface $flash, SessionInterface $session, TrickRepositoryInterface $trickRepository, ValidatorInterface $validator)
    {
        $this->handler = $handler;
        $this->imagesHandler = $imagesHandler;
        $this->formFactory = $formFactory;
        $this->flash = $flash;
        $this->session = $session;
        $this->trickRepository = $trickRepository;
        $this->validator = $validator;
    }

    /**
     * @Route("update-trick/{slug}", name="update-trick")
     * @param $slug
     * @param Request $request
     * @param UpdateTrickResponderInterface $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke($slug, Request $request, UpdateTrickResponderInterface $responder)
    {
        $trick = $this->trickRepository->getTrickBySlug($slug);
        //dd($trick);
        // build the form
        $form = $this->formFactory->create(UpdateTrickType::class, null, ['trick' => $trick])->handleRequest($request);
        $viewForm = $form->createView();

        if ($this->handler->new($form, $trick)) {
            // redirect to home page with success message
            $request->attributes->set('redirect', true);
            $this->session->getFlashBag()->add('success', 'Trick créé avec succé');
            return $responder($request, null, $trick, $form->getErrors(true));
        } else {
            return $responder($request, $viewForm, $trick, $form->getErrors(true));
        }


        return $responder($request, $viewForm);
    }
}
