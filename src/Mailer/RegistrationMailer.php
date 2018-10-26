<?php
/**
 * Created by Sabri Hamda.
 * Date: 28.09.18
 * Time: 18:15.
 */

namespace App\Mailer;

use App\Mailer\Interfaces\RegistrationMailerInterface;

/**
 * Class RegistrationMailer this Class send an email after registration.
 */
class RegistrationMailer implements RegistrationMailerInterface
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
     * RegistrationMailer constructor.
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
     * @param string $email
     * @param string $name
     * @param $validationToken
     * @return mixed|void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendTo(string $email, string $name, $validationToken)
    {
        $message = (new \Swift_Message('Snow Tricks'))
            ->setFrom('sabri@hamda.ch')
            ->setTo($email)
            ->setBody(
                $this->twig->render(
                    'emails/registration.html.twig',
                    array('name' => $name, 'token' => $validationToken)
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
