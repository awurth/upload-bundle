<?php

namespace Awurth\UploadBundle\Upload;

use Symfony\Component\HttpFoundation\File\File;

class UploadResult
{
    private $file;
    private $filename;

    public function __construct(File $file, string $filename)
    {
        $this->file = $file;
        $this->filename = $filename;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
