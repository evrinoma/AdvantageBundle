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

namespace Evrinoma\AdvantageBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\AdvantageBundle\Validator\AdvantageValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AdvantagePass extends AbstractConstraint implements CompilerPassInterface
{
    public const ADVANTAGE_CONSTRAINT = 'evrinoma.advantage.constraint.property';

    protected static string $alias = self::ADVANTAGE_CONSTRAINT;
    protected static string $class = AdvantageValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
