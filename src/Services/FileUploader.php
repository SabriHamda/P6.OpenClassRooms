<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services;

use App\Services\Interfaces\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class FileUploader
 * @package App\Services
 */
class FileUploader implements FileUploaderInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param File $image
     * @param string $hashedFileName
     * @param string $directory
     * @return mixed|string
     */
    public function upload(File $image, string $hashedFileName, string $directory)
    {
        $this->directory = $directory;
        try {
            $image->move($this->directory, $hashedFileName);
        } catch (FileException $e) {
            return $e->getMessage();
        }

        return $hashedFileName;
    }

}