<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services;


use App\Services\Interfaces\SlugifyInterface;

/**
 * Class Slugify
 * @package App\Services
 */
class Slugify
{

    /**
     * @param string $entry
     * @return string
     */
    public static function slugify(string $entry) :string
    {
        // replace non letter or digits by -
        $entry = preg_replace('~[^\pL\d]+~u', '-', $entry);

        // transliterate
        $entry = iconv('utf-8', 'us-ascii//TRANSLIT', $entry);

        // remove unwanted characters
        $entry = preg_replace('~[^-\w]+~', '', $entry);

        // trim
        $entry = trim($entry, '-');

        // remove duplicate -
        $entry = preg_replace('~-+~', '-', $entry);

        // lowercase
        $slug = strtolower($entry);

        if (empty($slug)) {
            return 'n-a';
        }

        return $slug;
    }
}