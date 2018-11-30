<?php
/**
 * This file is part of the Symfony P6.SnowTricks project.
 *
 * (c) Sabri Hamda <sabri@hamda.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Action;
use Symfony\Component\Routing\Annotation\Route;


/**
 * This Class add new images to each selected trick
 * Class AddImagesAction
 * @package App\UI\Action
 */
class AddImagesAction
{


    /**
     * AddImagesAction constructor.
     */
    public function __construct()
    {
    }

    /**
     * @Route("add-images", name="add-images")
     */
    public function __invoke($images)
    {

    }
}