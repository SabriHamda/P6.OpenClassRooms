<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Domain\Entity\Interfaces\MediaInterface;
use Ramsey\Uuid\Uuid;


/**
 * Class Media
 * @package App\Domain\Entity
 */
class Media implements MediaInterface
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $extension;

    /**
     * @var
     */
    private $size;

    /**
     * @var
     */
    private $publicUrl;

    /**
     * @var
     */
    private $createdAt;

    /**
     * @var
     */
    private $trick;

    /**
     * @var
     */
    private $trickId;

    /**
     * @var
     */
    private $videos;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     */
    private $type;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
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
     * @return mixed
     */
    public function getTrick(): Trick
    {
        return $this->trick;
    }


    public function getTrickId()
    {
        return $this->trickId;
    }

    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param $name
     * @param $extension
     * @param $size
     * @param $publicUrl
     * @param $trick
     * @throws \Exception
     */
    public function createImageMedia($name, $extension, $size, $publicUrl,$trick = null)
    {
        $this->trick = $trick;
        if (!$trick){
            $this->trickId = 'NOT_TRICK_IMAGE';
        }else{
            $this->trickId = $this->trick->getId();
        }
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->extension = $extension;
        $this->size = $size;
        $this->publicUrl = $publicUrl;
        $this->createdAt = new \DateTimeImmutable();
        $this->type = 'image';
    }

    /**
     * @param $trick
     * @param $video
     * @throws \Exception
     */
    public function createVideoMedia($trick,$video)
    {
        $this->trick = $trick;
        $this->id = Uuid::uuid4();
        $this->trickId = $this->trick->getId();
        $this->name = 'embed_video';
        $this->extension = 'mp4';
        $this->type = 'video';
        $this->size = 0000;
        $this->publicUrl = $video;
        $this->createdAt = new \DateTimeImmutable();

    }
}