<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\DTO;


class UpdateTrickDTO
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $videos;

    /**
     * @var
     */
    public $image;

    /**
     * @var string
     */
    public $category;


    /**
     * UpdateTrickDTO constructor.
     * @param $name
     * @param $description
     * @param $image
     * @param $videos
     * @param $category
     * @param $trick
     */
    public function __construct($name, $description, $image, $videos, $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->videos = $videos;
        $this->category = $category;
    }

}