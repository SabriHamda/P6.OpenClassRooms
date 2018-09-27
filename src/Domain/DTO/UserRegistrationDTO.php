<?php
/**
 * Created by Sabri Hamda.
 * Date: 26.09.18
 * Time: 17:37
 */

namespace App\Domain\DTO;


class UserRegistrationDTO
{
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;

    /**
     * UserRegistrationDTO constructor.
     * @param $username
     * @param $email
     * @param $pasword
     */
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}