<?php
/**
 * Created by Sabri Hamda.
 * Date: 25.09.18
 * Time: 14:50.
 */

namespace App\UI\Action;

use App\UI\Form\Handler\UserHandler;
use App\UI\Form\Type\UserType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


/**
 * Class RegisterAction
 * @package App\UI\Action
 */
class RegisterAction
{
    /**
     * @var UserHandler
     */
    private $userHandler;

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
     * RegisterAction constructor.
     * @param FormFactoryInterface $formFactory
     * @param UserHandler $userHandler
     * @param FlashBagInterface $flash
     * @param SessionInterface $session
     */
    public function __construct(FormFactoryInterface $formFactory, UserHandler $userHandler, FlashBagInterface $flash, SessionInterface $session)
    {
        $this->userHandler = $userHandler;
        $this->formFactory = $formFactory;
        $this->flash = $flash;
        $this->session = $session;
    }

    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @param RegisterResponderInterface $responder
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(Request $request, RegisterResponderInterface $responder)
    {

        // build the form
        $form = $this->formFactory->create(UserType::class)->handleRequest($request);
        $viewForm = $form->createView();

        if ($this->userHandler->new($form)) {
            // redirect to home page with success message
            $request->attributes->set('redirect','home');
            $this->session->getFlashBag()->add('success', 'Votre enregistrement a bien été pris en compte, pour valider votre inscription, merci de vous rendre dans votre boite mail.');
            return $responder($request);
        } else {
            return $responder($request, $viewForm, $this->userHandler->getErrors());
        }

        return $responder($request, $viewForm);

    }
}
