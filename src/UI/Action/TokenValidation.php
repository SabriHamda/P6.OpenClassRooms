<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\UI\Action;

use App\Repository\UserRepository;
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
     * @var FlashBag
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
    public function __construct(\Twig_Environment $twig, ManagerRegistry $manager, UserRepository $userRepository,FlashBagInterface $flash)
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
        if ($user){

            //validation des 24h du token
            $user->validate($token);
            $this->userRepository->update();
            $this->flash->add('success', 'Votre compte a été valider avec succé, vous pouvez vous loguer en cliquant <a href="/login">ici</a>.');

        }else {
            $this->flash->add('danger', 'Ce compte n\'existe pas ou a déja été validé' );
        }

        return $responder($user,$this->flash);
    }
}
