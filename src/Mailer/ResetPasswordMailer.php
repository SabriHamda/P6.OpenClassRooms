<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Mailer;


use App\Mailer\Interfaces\ResetPasswordMailerInterface;

class ResetPasswordMailer implements ResetPasswordMailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * ResetPasswordMailer constructor.
     *
     * @param \Swift_Mailer     $mailer
     * @param \Twig_Environment $twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param string $name
     * @param string $resetPasswordToken
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendTo(string $name, string $resetPasswordToken)
    {
        $message = (new \Swift_Message('Snow Tricks'))
            ->setFrom('sabri@hamda.ch')
            ->setTo('sabri@hamda.ch')
            ->setBody(
                $this->twig->render(
                    'emails/resetPassword.html.twig',
                    array('name' => $name, 'token' => $resetPasswordToken)
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}