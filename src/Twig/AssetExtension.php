<?php

namespace Awurth\UploadBundle\Twig;

use Awurth\UploadBundle\Storage\StorageInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uploaded_asset', [$this, 'asset'])
        ];
    }

    public function asset($object, string $mappingName): ?string
    {
        return $this->storage->resolveUri($object, $mappingName);
    }
}
