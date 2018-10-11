<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\DTO;


class ResetPasswordDoDTO
{
    /**
     * @var string
     */
    public $password;

    /**
     * ResetPasswordDoDTO constructor.
     * @param $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

}