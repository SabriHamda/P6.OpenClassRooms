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
     * FileUploaderInterface constructor.
     * @param string $targetDirectory
     */
    public function __construct(string $targetDirectory);


    /**
     * @param File $image
     * @param string $hashedFileName
     * @return mixed
     */
    public function upload(File $image, string $hashedFileName);


    /**
     * @return string
     */
    public function getTargetDirectory(): string;
}