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

namespace Evrinoma\AdvantageBundle\DependencyInjection\Compiler;

use Evrinoma\AdvantageBundle\DependencyInjection\EvrinomaAdvantageExtension;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ('orm' === $container->getParameter('evrinoma.advantage.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaAdvantageExtension::ENTITY]);

            $entityAdvantage = $container->getParameter('evrinoma.advantage.entity');
            if (str_contains($entityAdvantage, EvrinomaAdvantageExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Advantage', '%s/Entity/Advantage');
            }
            $this->addResolveTargetEntity([$entityAdvantage => [AdvantageInterface::class => []]], false);
        }
    }
}
