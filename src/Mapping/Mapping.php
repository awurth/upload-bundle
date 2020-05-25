<?php

namespace Awurth\UploadBundle\Mapping;

use Awurth\UploadBundle\Naming\NamerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Mapping
{
    private $directoryNamer;
    private $namer;
    private $propertyPath;
    private $uploadDestination;
    private $uriPrefix;

    public function __construct(string $uploadDestination, string $uriPrefix, string $propertyPath)
    {
        $this->uploadDestination = $uploadDestination;
        $this->uriPrefix = $uriPrefix;
        $this->propertyPath = $propertyPath;
    }

    public function getUploadName(UploadedFile $file): string
    {
        return $this->getNamer()->name($file);
    }

    public function getDirectoryNamer(): ?NamerInterface
    {
        return $this->directoryNamer;
    }

    public function setDirectoryNamer(?NamerInterface $directoryNamer): void
    {
        $this->directoryNamer = $directoryNamer;
    }

    public function getNamer(): ?NamerInterface
    {
        return $this->namer;
    }

    public function setNamer(?NamerInterface $namer): void
    {
        $this->namer = $namer;
    }

    public function getPropertyPath(): string
    {
        return $this->propertyPath;
    }

    public function setPropertyPath(string $propertyPath): void
    {
        $this->propertyPath = $propertyPath;
    }

    public function getUploadDestination(): string
    {
        return $this->uploadDestination;
    }

    public function setUploadDestination(string $uploadDestination): void
    {
        $this->uploadDestination = $uploadDestination;
    }

    public function getUriPrefix(): string
    {
        return $this->uriPrefix;
    }

    public function setUriPrefix(string $uriPrefix): void
    {
        $this->uriPrefix = $uriPrefix;
    }
}
