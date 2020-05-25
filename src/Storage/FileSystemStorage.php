<?php

namespace Awurth\UploadBundle\Storage;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileSystemStorage extends AbstractStorage
{
    public function remove($object, string $mappingName): bool
    {
        $file = $this->resolvePath($object, $mappingName);

        return file_exists($file) ? unlink($file) : false;
    }

    public function upload(UploadedFile $file, $object, string $mappingName): File
    {
        $mapping = $this->getMapping($mappingName);

        $name = $mapping->getUploadName($file);

        $movedFile = $file->move($mapping->getUploadDestination(), $name);

        $this->remove($object, $mappingName);

        $this->propertyAccessor->setValue($object, $mapping->getPropertyPath(), $name);

        return $movedFile;
    }

    public function resolveUri($object, string $mappingName): ?string
    {
        $mapping = $this->getMapping($mappingName);

        $filename = $this->getFilename($object, $mapping);

        if (!$filename) {
            return null;
        }

        return $mapping->getUriPrefix().'/'.$filename;
    }

    public function resolvePath($object, string $mappingName): ?string
    {
        $mapping = $this->getMapping($mappingName);

        $filename = $this->getFilename($object, $mapping);

        if (!$filename) {
            return null;
        }

        return $mapping->getUploadDestination().DIRECTORY_SEPARATOR.$filename;
    }
}
