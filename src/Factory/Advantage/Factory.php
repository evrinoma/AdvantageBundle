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

namespace Evrinoma\AdvantageBundle\Factory\Advantage;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Entity\Advantage\BaseAdvantage;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

class Factory implements FactoryInterface
{
    private static string $entityClass = BaseAdvantage::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     */
    public function create(AdvantageApiDtoInterface $dto): AdvantageInterface
    {
        /* @var BaseAdvantage $advantage */
        return new self::$entityClass();
    }
}
