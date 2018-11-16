<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Domain\DTO;


class AddTrickDTO
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
    public $image;

    /**
     * @var string
     */
    public $videos;

    /**
     * @var string
     */
    public $category;

    /**
     * AddTrickDTO constructor.
     * @param $name
     * @param $description
     * @param $image
     * @param $videos
     * @param $category
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