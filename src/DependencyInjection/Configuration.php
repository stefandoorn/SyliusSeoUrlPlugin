<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('sylius_seo_url_plugin');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
