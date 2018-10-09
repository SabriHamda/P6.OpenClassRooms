<?php
/**
 * Created by Sabri Hamda <sabri@hamda.ch>
 */

namespace App\Services\Interfaces;


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
     * @param string $file
     * @param string $hashedFileName
     * @return mixed
     */
    public function upload(string $file, string $hashedFileName);


    /**
     * @return string
     */
    public function getTargetDirectory() :string ;
}