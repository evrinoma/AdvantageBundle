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

namespace Evrinoma\AdvantageBundle\Repository\Advantage;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Exception\AdvantageProxyException;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

interface AdvantageQueryRepositoryInterface
{
    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AdvantageNotFoundException
     */
    public function findByCriteria(AdvantageApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): AdvantageInterface;

    /**
     * @param string $id
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageProxyException
     * @throws ORMException
     */
    public function proxy(string $id): AdvantageInterface;
}
