<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class FileUploader
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload($file,$hashedFileName)
    {

        $objFile = new File($file);

        try {
            $objFile->move($this->getTargetDirectory(), $hashedFileName);
        } catch (FileException $e) {
            return $e->getMessage();
        }

        return $hashedFileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}