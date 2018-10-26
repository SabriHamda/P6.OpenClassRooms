<?php
/**
 * Created by Sabri Hamda.
 * Date: 28.09.18
 * Time: 19:37.
 */

namespace App\Mailer\Interfaces;

/**
 * Interface RegistrationMailerInterface.
 */
interface RegistrationMailerInterface
{
    /**
     * RegistrationMailerInterface constructor.
     *
     * @param \Swift_Mailer     $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig);

    /**
     * @param string $email
     * @param string $name
     * @param $validationToken
     * @return mixed
     */
    public function sendTo(string $email, string $name, $validationToken);
}
