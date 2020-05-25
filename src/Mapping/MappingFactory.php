<?php

namespace Awurth\UploadBundle\Mapping;

use Awurth\UploadBundle\Exception\MappingNotFoundException;
use Awurth\UploadBundle\Naming\NamerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MappingFactory
{
    private $container;
    private $mappings;

    public function __construct(ContainerInterface $container, array $mappings)
    {
        $this->container = $container;
        $this->mappings = $mappings;
    }

    public function create(string $name): Mapping
    {
        if (!array_key_exists($name, $this->mappings)) {
            throw new MappingNotFoundException('Mapping not found');
        }

        $config = $this->mappings[$name];

        $mapping = new Mapping($config['upload_destination'], $config['uri_prefix'], $config['property_path']);

        if ($config['namer']['service'] ?? null) {
            /** @var NamerInterface $namer */
            $namer = $this->container->get($config['namer']['service']);

            $mapping->setNamer($namer);
        }

        return $mapping;
    }
}
