<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Domain\Repository\UserRepository;
use App\UI\Responder\TokenValidationResponder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
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
     * @var FlashBagInterface
     */
    private $flash;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ManagerRegistry
     */
    private $manager;

    /**
     * TokenValidation constructor.
     * @param \Twig_Environment $twig
     * @param ManagerRegistry $manager
     * @param UserRepository $userRepository
     * @param FlashBagInterface $flash
     */
    public function __construct(\Twig_Environment $twig, ManagerRegistry $manager, UserRepository $userRepository, FlashBagInterface $flash)
    {
        $this->twig = $twig;
        $this->flash = $flash;
        $this->userRepository = $userRepository;
        $this->manager = $manager;
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
                $this->flash->add('danger', 'Désolé <strong>temp écoulé</strong> , vous disposez de 24h pour valider votre adresse mail<br>Pour vous renregistrer merci de <a href="/register">cliquez ici</a>.');
            } else {
                $user->validate();
                $this->userRepository->update();
                $this->flash->add('success', 'Votre compte a été valider avec succé, vous pouvez vous loguer en cliquant <a href="/login">ici</a>.');
            }
        } else {
            $this->flash->add('danger', 'Ce compte n\'existe pas.');
        }

        return $responder($user, $this->flash);
    }
}
