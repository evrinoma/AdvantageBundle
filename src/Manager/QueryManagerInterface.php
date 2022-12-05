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
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Exception\AdvantageProxyException;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface QueryManagerInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AdvantageNotFoundException
     */
    public function criteria(AdvantageApiDtoInterface $dto): array;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageNotFoundException
     */
    public function get(AdvantageApiDtoInterface $dto): AdvantageInterface;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageProxyException
     */
    public function proxy(AdvantageApiDtoInterface $dto): AdvantageInterface;
}
