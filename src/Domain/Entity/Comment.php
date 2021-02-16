<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Class Comment
 * @package App\Domain\Entity
 */
class Comment
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $author;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }



    /**
     * @param $content
     * @param $author
     * @throws \Exception
     */
    public function create($content,$author)
    {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->createdAt = new \DateTimeImmutable();
        $this->author = $author;
    }



}