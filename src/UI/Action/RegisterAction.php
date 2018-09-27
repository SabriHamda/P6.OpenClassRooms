<?php
/**
 * Created by Sabri Hamda.
 * Date: 25.09.18
 * Time: 14:50
 */

namespace App\UI\Action;

use App\Form\UserType;
use App\Entity\User;
use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegisterAction
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formfactory;

    /**
     * @var ManagerRegistry
     */
    private $manager;

    /**
     * @var FlashBagInterface
     */
    private $flash;

    /**
     * @var RedirectResponse
     */
    private $redirectResponse;

    /**
     * RegisterAction constructor.
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param ManagerRegistry $manager
     * @param FlashBagInterface $flash
     * @param RedirectResponse $redirectResponse
     */
    public function __construct(Environment $twig, FormFactoryInterface $formFactory, ManagerRegistry $manager, FlashBagInterface $flash, UrlGeneratorInterface $generateUrl)
    {
        $this->twig = $twig;
        $this->formfactory = $formFactory;
        $this->manager = $manager;
        $this->flash = $flash;
        $this->redirectResponse = $generateUrl;
    }

    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @param EncoderFactoryInterface $encoderFactory
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(Request $request, EncoderFactoryInterface $encoderFactory, RegisterResponderInterface $responder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->formfactory->create(UserType::class)->handleRequest($request);

        // 2) handle the submit (will only happen on POST)
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
            $user->create(
                $form->getData()->username,
                $form->getData()->email,
                $password
            );

            // 4) save the User!
            $entityManager = $this->manager->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->flash->add('success', 'je suis le message');

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return new RedirectResponse($this->redirectResponse->generate('frontend-home'));
        }

        $viewForm = $form->createView();
        return $responder($request, $viewForm);
    }
}
