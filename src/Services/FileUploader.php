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
    private $targetDirectory;

    /**
     * FileUploader constructor.
     * @param $targetDirectory
     */
    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param File $image
     * @param string $hashedFileName
     * @return mixed|string
     */
    public function upload(File $image, string $hashedFileName)
    {
        try {
            $image->move($this->getTargetDirectory(), $hashedFileName);
        } catch (FileException $e) {
            return $e->getMessage();
        }

        return $hashedFileName;
    }

    /**
     * @return string
     */
    public function getTargetDirectory():string
    {
        return $this->targetDirectory;
    }
}