<?php
/**
 * Created by Sabri Hamda.
 * Date: 12.09.18
 * Time: 20:38.
 */

namespace App\Entity;

use App\Entity\Interfaces\MediaInterface;
use App\Services\Interfaces\SlugifyInterface;

/**
 * Class Trick
 * @package App\Entity
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
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
     * @param $createdAt
     */
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param $name
     * @param $description
     * @param MediaInterface $image
     * @throws \Exception
     */
    public function create($name,$description,MediaInterface $image)
    {
        $this->name = $name;
        $this->slug = SlugifyInterface::slugify($name);
        $this->image = $image;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable();
    }
}
