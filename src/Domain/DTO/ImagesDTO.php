<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\DTO;


/**
 * Class ImagesDTO
 * @package App\Domain\DTO
 */
class ImagesDTO
{

    /**
     * @var array
     */
    public $image = [];

    /**
     * ImagesDTO constructor.
     * @param array $images
     */
    public function __construct(array $image)
    {
        $this->image = $image;
    }

}