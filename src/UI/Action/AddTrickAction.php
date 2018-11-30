<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;


use App\Services\Slugify;
use App\UI\Form\Handler\AddTrickHandler;
use App\UI\Form\Type\AddTrickType;
use App\UI\Form\Type\ImagesType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\UI\Responder\Interfaces\AddTrickResponderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AddTrickAction
{

    /**
     * @var handler
     */
    private $handler;

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
     * AddTrickAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param AddTrickHandler $handler
     * @param FlashBagInterface $flash
     * @param SessionInterface $session
     */
    public function __construct(FormFactoryInterface $formFactory, AddTrickHandler $handler, FlashBagInterface $flash, SessionInterface $session)
    {
        $this->handler = $handler;
        $this->formFactory = $formFactory;
        $this->flash = $flash;
        $this->session = $session;
    }

    /**
     * @Route("add-trick", name="add-trick")
     * @param Request $request
     * @param AddTrickResponderInterface $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(Request $request, AddTrickResponderInterface $responder)
    {
        // build the form
        $form = $this->formFactory->create(AddTrickType::class)->handleRequest($request);
        $viewForm = $form->createView();

        if ($this->handler->new($form)) {
            // redirect to home page with success message
            $slug = Slugify::slugify($form->getData()->name);
            $request->attributes->set('redirect', 'view-trick');
            $this->session->getFlashBag()->add('success', 'Trick créé avec succès');
            return $responder($request, null,null,$slug);
        } else {
            //$this->session->getFlashBag()->add('danger', 'Il y a quelques erreurs sur cette page.');
            return $responder($request, $viewForm, $this->handler->getErrors(),null);
        }

        return $responder($request, $viewForm);
    }


}