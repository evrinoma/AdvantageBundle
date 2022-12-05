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

namespace Evrinoma\AdvantageBundle\PreValidator;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @throws AdvantageInvalidException
     */
    public function onPost(AdvantageApiDtoInterface $dto): void;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @throws AdvantageInvalidException
     */
    public function onPut(AdvantageApiDtoInterface $dto): void;

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @throws AdvantageInvalidException
     */
    public function onDelete(AdvantageApiDtoInterface $dto): void;
}
