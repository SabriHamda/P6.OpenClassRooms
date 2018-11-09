<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Entity;


use App\Domain\Entity\Interfaces\MediaInterface;
use Ramsey\Uuid\Uuid;

class Media implements MediaInterface
{
    private $uuid;

    private $name;

    private $extension;

    private $size;

    private $publicUrl;

    private $createdAt;

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
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
    public function getPublicUrl()
    {
        return $this->publicUrl;
    }

    /**
     * @param $name
     * @param $extension
     * @param $size
     * @param $publicUrl
     * @throws \Exception
     */
    public function create($name, $extension, $size, $publicUrl)
    {
        $this->uuid = Uuid::uuid4();
        $this->name = $name;
        $this->extension = $extension;
        $this->size = $size;
        $this->publicUrl = $publicUrl;
        $this->createdAt = new \DateTimeImmutable();
    }
}