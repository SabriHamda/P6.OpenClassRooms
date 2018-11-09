<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services\Interfaces;


/**
 * Interface SlugifyInterface
 * @package App\Services\Interfaces
 */
interface SlugifyInterface
{

    /**
     * @param string $entry
     * @return string
     */
    public static function slugify(string $entry) : string ;


}