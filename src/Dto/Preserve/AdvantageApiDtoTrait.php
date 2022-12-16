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

namespace Evrinoma\AdvantageBundle\Dto\Preserve;

use Evrinoma\AdvantageBundle\DtoCommon\ValueObject\Preserve\LogoTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\BodyTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\PositionTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\TitleTrait;

trait AdvantageApiDtoTrait
{
    use ActiveTrait;
    use BodyTrait;
    use IdTrait;
    use LogoTrait;
    use PositionTrait;
    use TitleTrait;
}
