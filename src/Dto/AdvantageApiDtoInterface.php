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

namespace Evrinoma\AdvantageBundle\Dto;

use Evrinoma\AdvantageBundle\DtoCommon\ValueObject\Immutable\LogoInterface;
use Evrinoma\AdvantageBundle\DtoCommon\ValueObject\Immutable\PositionInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\BodyInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\TitleInterface;

interface AdvantageApiDtoInterface extends DtoInterface, IdInterface, LogoInterface, TitleInterface, BodyInterface, PositionInterface, ActiveInterface
{
}
