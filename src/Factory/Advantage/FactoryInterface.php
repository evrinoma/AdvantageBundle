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

namespace Evrinoma\AdvantageBundle\Factory;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface FactoryInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     */
    public function create(AdvantageApiDtoInterface $dto): AdvantageInterface;
}
