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

namespace Evrinoma\AdvantageBundle\Manager;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeRemovedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageInvalidException;
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface CommandManagerInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageInvalidException
     */
    public function post(AdvantageApiDtoInterface $dto): AdvantageInterface;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageInvalidException
     * @throws AdvantageNotFoundException
     */
    public function put(AdvantageApiDtoInterface $dto): AdvantageInterface;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @throws AdvantageCannotBeRemovedException
     * @throws AdvantageNotFoundException
     */
    public function delete(AdvantageApiDtoInterface $dto): void;
}
