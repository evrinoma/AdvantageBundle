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

namespace Evrinoma\AdvantageBundle\Model\Advantage;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\ActiveTrait;
use Evrinoma\UtilsBundle\Entity\BodyTrait;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\LogoTrait;
use Evrinoma\UtilsBundle\Entity\PositionTrait;
use Evrinoma\UtilsBundle\Entity\TitleTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractAdvantage implements AdvantageInterface
{
    use ActiveTrait;
    use BodyTrait;
    use CreateUpdateAtTrait;
    use IdTrait;
    use LogoTrait;
    use PositionTrait;
    use TitleTrait;
}
