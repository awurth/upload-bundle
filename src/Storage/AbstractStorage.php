<?php

namespace Awurth\UploadBundle\Storage;

use Awurth\UploadBundle\Mapping\Mapping;
use Awurth\UploadBundle\Mapping\MappingFactory;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

abstract class AbstractStorage implements StorageInterface
{
    protected $mappingFactory;
    protected $propertyAccessor;

    public function __construct(MappingFactory $mappingFactory, PropertyAccessorInterface $propertyAccessor)
    {
        $this->mappingFactory = $mappingFactory;
        $this->propertyAccessor = $propertyAccessor;
    }

    protected function getFilename($object, Mapping $mapping): ?string
    {
        return $this->propertyAccessor->getValue($object, $mapping->getPropertyPath());
    }

    protected function getMapping(string $name): Mapping
    {
        return $this->mappingFactory->create($name);
    }
}
