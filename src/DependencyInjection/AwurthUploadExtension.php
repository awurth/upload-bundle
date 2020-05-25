<?php

namespace Awurth\UploadBundle\DependencyInjection;

use Awurth\UploadBundle\Storage\FileSystemStorage;
use Awurth\UploadBundle\Storage\StorageInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class AwurthUploadExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('awurth_upload.mappings', $config['mappings']);

        $this->loadServicesFiles($container);

        $container->setAlias(StorageInterface::class, new Alias(FileSystemStorage::class, false));
    }

    private function loadServicesFiles(ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../../config'));

        $toLoad = ['namer.xml', 'mapping.xml', 'storage.xml', 'twig.xml'];

        foreach ($toLoad as $file) {
            $loader->load($file);
        }
    }
}
