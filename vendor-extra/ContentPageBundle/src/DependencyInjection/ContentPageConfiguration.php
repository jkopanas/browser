<?php

declare(strict_types=1);

namespace Libero\ContentPageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ContentPageConfiguration implements ConfigurationInterface
{
    private $rootName;

    public function __construct(string $rootName)
    {
        $this->rootName = $rootName;
    }

    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->root($this->rootName);
        $rootNode
            ->fixXmlConfig('page')
            ->children()
                ->append($this->getPagesDefinition())
            ->end()
        ;
        return $treeBuilder;
    }

    private function getPagesDefinition() : ArrayNodeDefinition
    {
        $builder = new TreeBuilder();
        /** @var ArrayNodeDefinition $pagesNode */
        $pagesNode = $builder->root('pages');
        $pagesNode
            ->arrayPrototype()
                ->children()
                ->end()
            ->end()
        ;
        return $pagesNode;
    }
}