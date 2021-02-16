<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services\Interfaces;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface FileUploaderInterface
 * @package App\Services\Interfaces
 */
interface FileUploaderInterface
{

    /**
     * @param File $image
     * @param string $hashedFileName
     * @param string $directory
     * @return mixed
     */
    public function upload(File $image, string $hashedFileName,string $directory);

}