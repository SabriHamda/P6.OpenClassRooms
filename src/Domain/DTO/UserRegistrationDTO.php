<?php
/**
 * Created by Sabri Hamda.
 * Date: 26.09.18
 * Time: 17:37.
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
     * @var string
     */
    public $image;

    /**
     * UserRegistrationDTO constructor.
     * @param $username
     * @param $email
     * @param $password
     * @param $image
     */
    public function __construct($username, $email, $password,$image)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
    }
}
