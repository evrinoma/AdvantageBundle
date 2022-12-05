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

namespace Evrinoma\AdvantageBundle;

use Evrinoma\AdvantageBundle\DependencyInjection\Compiler\Constraint\Property\AdvantagePass;
use Evrinoma\AdvantageBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\AdvantageBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\AdvantageBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\AdvantageBundle\DependencyInjection\EvrinomaAdvantageExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaAdvantageBundle extends Bundle
{
    public const BUNDLE = 'advantage';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new AdvantagePass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaAdvantageExtension();
        }

        return $this->extension;
    }
}
