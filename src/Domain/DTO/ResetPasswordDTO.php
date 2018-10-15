<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\DTO;


class ResetPasswordDTO
{

    /**
     * @var
     */
    public $email;

    /**
     * ResetPasswordDTO constructor.
     * @param $email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }
}