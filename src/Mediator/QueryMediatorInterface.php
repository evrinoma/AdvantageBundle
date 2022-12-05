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
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param AdvantageApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(AdvantageApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param AdvantageApiDtoInterface $dto
     * @param QueryBuilderInterface $builder
     *
     * @return array
     */
    public function getResult(AdvantageApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
