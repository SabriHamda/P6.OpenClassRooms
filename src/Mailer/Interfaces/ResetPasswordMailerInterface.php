<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Mailer\Interfaces;


interface ResetPasswordMailerInterface
{

    /**
     * ResetPasswordMailerInterface constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig);

    /**
     * @param string $name
     * @param string $resetPasswordToken
     * @return mixed
     */
    public function sendTo(string $name, string $resetPasswordToken);

}