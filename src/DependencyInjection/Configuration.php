<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\AdvantageBundle\DependencyInjection;

use Evrinoma\AdvantageBundle\EvrinomaAdvantageBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaAdvantageBundle::BUNDLE);
        $rootNode = $treeBuilder->getRootNode();
        $supportedDrivers = ['orm'];

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('db_driver')
            ->validate()
            ->ifNotInArray($supportedDrivers)
            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
            ->end()
            ->cannotBeOverwritten()
            ->defaultValue('orm')
            ->end()
            ->scalarNode('factory')->cannotBeEmpty()->defaultValue(EvrinomaAdvantageExtension::ENTITY_FACTORY_ADVANTAGE)->end()
            ->scalarNode('entity')->cannotBeEmpty()->defaultValue(EvrinomaAdvantageExtension::ENTITY_BASE_ADVANTAGE)->end()
            ->scalarNode('constraints')->defaultTrue()->info('This option is used to enable/disable basic advantage constraints')->end()
            ->scalarNode('dto')->cannotBeEmpty()->defaultValue(EvrinomaAdvantageExtension::DTO_BASE_ADVANTAGE)->info('This option is used to dto class override')->end()
            ->arrayNode('decorates')->addDefaultsIfNotSet()->children()
            ->scalarNode('command')->defaultNull()->info('This option is used to command advantage decoration')->end()
            ->scalarNode('query')->defaultNull()->info('This option is used to query advantage decoration')->end()
            ->end()->end()
            ->arrayNode('services')->addDefaultsIfNotSet()->children()
            ->scalarNode('pre_validator')->defaultNull()->info('This option is used to pre_validator overriding')->end()
            ->scalarNode('handler')->cannotBeEmpty()->defaultValue(EvrinomaAdvantageExtension::HANDLER)->info('This option is used to handler override')->end()
            ->scalarNode('file_system')->defaultNull()->info('This option is used to file system override')->end()
            ->end()->end()
            ->end();

        return $treeBuilder;
    }
}
