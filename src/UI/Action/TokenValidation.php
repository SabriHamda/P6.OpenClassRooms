<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Domain\Repository\UserRepository;
use App\UI\Responder\TokenValidationResponder;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * Class TokenValidation
 * @package App\UI\Action
 */
class TokenValidation
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ManagerRegistry
     */
    private $manager;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * TokenValidation constructor.
     * @param \Twig_Environment $twig
     * @param ManagerRegistry $manager
     * @param UserRepository $userRepository
     * @param SessionInterface $session
     */
    public function __construct(\Twig_Environment $twig, ManagerRegistry $manager, UserRepository $userRepository, SessionInterface $session)
    {
        $this->twig = $twig;
        $this->userRepository = $userRepository;
        $this->manager = $manager;
        $this->session = $session;
    }

    /**
     * @Route("validation/{token}", name="token_validation")
     * @param $token
     * @param TokenValidationResponder $responder
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($token, TokenValidationResponder $responder)
    {
        $user = $this->userRepository->findOneBy(['validationToken' => $token]);

        if ($user) {
            //if token existe in DB since 24h, remove user go to registration
            if ($user->validationDateDiff() > 0) {
                $this->userRepository->remove($user);
                $this->session->getFlashBag()->add('warning', 'Désolé vous disposez de 24h pour valider votre adresse mail.');
                return $responder($user);
            } else {
                $user->validate();
                $this->userRepository->update();
                $this->session->getFlashBag()->add('info', 'Votre compte a été valider avec succé.');
                return $responder($user);
            }
        } else {
            $this->session->getFlashBag()->add('danger', 'Ce compte n\'existe pas.');
            return $responder();
        }

        return $responder();
    }
}
