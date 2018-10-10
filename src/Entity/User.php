<?php
/**
 * Created by Sabri Hamda.
 * Date: 23.09.18
 * Time: 13:48.
 */

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User.
 */
class User implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $roles;
    /**
     * @var string
     */
    private $image;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $validationToken;

    /**
     * @var
     */
    private $resetPasswordToken;


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    /**
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getValidationToken()
    {
        return $this->validationToken;
    }

    /**
     * @return mixed
     */
    public function getResetPasswordToken()
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param $resetPasswordToken
     */
    public function setResetPasswordToken($resetPasswordToken)
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    /**
     *
     */
    public function eraseCredentials()
    {
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $plainPassword
     * @param string $password
     * @param string $image
     * @throws \Exception
     */
    public function create(string $username, string $email, string $plainPassword, string $password, string $image)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->plainPassword = $plainPassword;
        $this->createdAt = new \DateTimeImmutable();
        $this->validationToken = bin2hex(random_bytes(32));
        $this->isActive = false;
        $this->image = $image;
    }

    /**
     * @param string $token
     */
    public function validate(string $token)
    {
        $this->isActive = true;
        $this->roles[] = 'ROLE_USER';
        $this->validationToken = null;
        $this->validationToken = $token;
    }

    /**
     * @return int
     */
    public function validationDateDiff()
    {
        $createdAt = $this->getCreatedAt();
        $toDay = date_create('NOW');
        $diff = date_diff($createdAt, $toDay);
        return $diff->format('%a');
    }
}
