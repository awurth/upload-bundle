<?php

namespace Awurth\UploadBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $builder = new TreeBuilder('awurth_upload');
        $root = $builder->getRootNode();

        $root
            ->children()
                ->arrayNode('mappings')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('uri_prefix')->isRequired()->end()
                            ->scalarNode('upload_destination')->isRequired()->end()
                            ->scalarNode('property_path')->isRequired()->end()
                            ->arrayNode('namer')
                                ->addDefaultsIfNotSet()
                                ->beforeNormalization()
                                    ->ifString()
                                    ->then(static function ($v) {
                                        return ['service' => $v];
                                    })
                                ->end()
                                ->children()
                                    ->scalarNode('service')->defaultNull()->end()
                                ->end()
                            ->end()
                            ->scalarNode('directory_namer')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
