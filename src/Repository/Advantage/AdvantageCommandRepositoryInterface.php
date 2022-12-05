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

namespace Evrinoma\AdvantageBundle\Repository\Advantage;

use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeRemovedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeSavedException;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface AdvantageCommandRepositoryInterface
{
    /**
     * @param AdvantageInterface $advantage
     *
     * @return bool
     *
     * @throws AdvantageCannotBeSavedException
     */
    public function save(AdvantageInterface $advantage): bool;

    /**
     * @param AdvantageInterface $advantage
     *
     * @return bool
     *
     * @throws AdvantageCannotBeRemovedException
     */
    public function remove(AdvantageInterface $advantage): bool;
}
