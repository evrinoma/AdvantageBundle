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

namespace Evrinoma\AdvantageBundle\Entity\Advantage;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\AdvantageBundle\Model\Advantage\AbstractAdvantage;

/**
 * @ORM\Table(name="e_advantage")
 * @ORM\Entity
 */
class BaseAdvantage extends AbstractAdvantage
{
}
