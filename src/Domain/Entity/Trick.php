<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 20:38.
 */

namespace App\Domain\Entity;

use App\Domain\Entity\Interfaces\CategoryInterface;
use App\Domain\Entity\Interfaces\MediaInterface;
use App\Services\Slugify;
use Ramsey\Uuid\Uuid;

/**
 * Class Trick
 * @package App\Domain\Entity
 */
class Trick
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var int
     */
    private $commentId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var
     */
    private $media = [];

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $category;

    private $user;

    private $userId;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return int
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param $name
     * @param $description
     * @param MediaInterface $media
     * @throws \Exception
     */
    public function create(string $name,string $description,MediaInterface $media, CategoryInterface $category,User $user)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->slug = Slugify::slugify($name);
        $this->media []= $media;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable();
        $this->category = $category;
        $this->categoryId = $this->category->getId();
        $this->user = $user;
        $this->userId = $user->getId();

    }

}
