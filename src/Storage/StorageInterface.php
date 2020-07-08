<?php

namespace Awurth\UploadBundle\Storage;


use Awurth\UploadBundle\Upload\UploadResult;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface StorageInterface
{
    public function remove($object, string $mappingName): bool;

    public function resolvePath($object, string $mappingName): ?string;

    public function resolveUri($object, string $mappingName): ?string;

    public function upload(UploadedFile $file, $object, string $mappingName): UploadResult;
}
