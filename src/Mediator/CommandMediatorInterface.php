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

namespace Evrinoma\AdvantageBundle\Mediator;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeCreatedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeRemovedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeSavedException;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface CommandMediatorInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     * @param AdvantageInterface       $entity
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageCannotBeSavedException
     */
    public function onUpdate(AdvantageApiDtoInterface $dto, AdvantageInterface $entity): AdvantageInterface;

    /**
     * @param AdvantageApiDtoInterface $dto
     * @param AdvantageInterface       $entity
     *
     * @throws AdvantageCannotBeRemovedException
     */
    public function onDelete(AdvantageApiDtoInterface $dto, AdvantageInterface $entity): void;

    /**
     * @param AdvantageApiDtoInterface $dto
     * @param AdvantageInterface       $entity
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageCannotBeSavedException
     * @throws AdvantageCannotBeCreatedException
     */
    public function onCreate(AdvantageApiDtoInterface $dto, AdvantageInterface $entity): AdvantageInterface;
}
