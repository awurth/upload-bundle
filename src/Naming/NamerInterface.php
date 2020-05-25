<?php

namespace Awurth\UploadBundle\Naming;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface NamerInterface
{
    public function name(UploadedFile $file): string;
}
