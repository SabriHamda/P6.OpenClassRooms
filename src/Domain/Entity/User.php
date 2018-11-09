<?php
/**
 * Created by Sabri Hamda.
 * Date: 23.09.18
 * Time: 13:48.
 */

namespace App\Entity;

use App\Entity\Interfaces\MediaInterface;
use Ramsey\Uuid\Uuid;
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
    private $password;

    /**
     * @var array
     */
    private $roles = [];
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
     * @param string $password
     * @param string $image
     * @throws \Exception
     */
    public function create(string $username, string $email, string $password, MediaInterface $image)
    {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new \DateTimeImmutable();
        $this->validationToken = bin2hex(random_bytes(32));
        $this->isActive = false;
        $this->image = $image;
    }

    /**
     * This method is executed after token is checked in db
     */
    public function validate()
    {
        $this->isActive = true;
        $this->roles[] = 'ROLE_USER';
        $this->validationToken = null;
        //$this->validationToken = $token;

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

    /**
     * @param string $password
     */
    public function updatePassword(string $password): void
    {
        $this->password = $password;
        $this->resetPasswordToken = null;
        $this->updatedAt = new \DateTimeImmutable();
    }
}
