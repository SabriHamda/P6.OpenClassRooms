<?php
/**
 * Created by Sabri Hamda.
 * Date: 25.09.18
 * Time: 14:50.
 */

namespace App\UI\Action;

use App\Form\UserType;
use App\Entity\User;
use App\Mailer\RegistrationMailer;
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
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var \Swift_Mailer
     */
    private $mailer;

    private $configPath;

    /**
     * RegisterAction constructor.
     *
     * @param Environment          $twig
     * @param FormFactoryInterface $formFactory
     * @param ManagerRegistry      $manager
     * @param FlashBagInterface    $flash
     * @param RedirectResponse     $redirectResponse
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer, FormFactoryInterface $formFactory, ManagerRegistry $manager, FlashBagInterface $flash, UrlGeneratorInterface $generateUrl, string $configPath)
    {
        $this->twig = $twig;
        $this->formfactory = $formFactory;
        $this->manager = $manager;
        $this->flash = $flash;
        $this->redirectResponse = $generateUrl;
        $this->mailer = $mailer;
        $this->configPath = $configPath;
    }

    /**
     * @Route("/register", name="user_registration")
     *
     * @param Request                 $request
     * @param EncoderFactoryInterface $encoderFactory
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function __invoke(Request $request, EncoderFactoryInterface $encoderFactory, RegisterResponderInterface $responder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->formfactory->create(UserType::class)->handleRequest($request);
        $validator = Validation::createValidatorBuilder()
            ->addXmlMapping($this->configPath.'validator/validation.xml')
            ->getValidator();


        // 2) handle the submit (will only happen on POST)
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->getData()->password;
            $encryptedPassword = $encoderFactory->getEncoder(User::class)->encodePassword($form->getData()->password, null);
            $user->create(
                $form->getData()->username,
                $form->getData()->email,
                $plainPassword,
                $encryptedPassword
            );

            // Use validator to validate form
            $errors = $validator->validate($user);
            if (count($errors) > 0){
                $viewForm = $form->createView();
                return $responder($request, $viewForm,$errors);
            }else{
                // 4) save the User!
                $entityManager = $this->manager->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // 5) send an email with token
                $mailer = new RegistrationMailer($this->mailer, $this->twig);
                $mailer->sendTo($form->getData()->username, $user->getValidationToken());

                // 6) redirect to home page with success message
                $this->flash->add('success', 'Votre enregistrement a bien été pris en compte, pour valider votre inscription, merci de vous rendre dans votre boite mail.');

                return new RedirectResponse($this->redirectResponse->generate('frontend-home'));
            }

        }

        $viewForm = $form->createView();
        return $responder($request, $viewForm);
    }
}
