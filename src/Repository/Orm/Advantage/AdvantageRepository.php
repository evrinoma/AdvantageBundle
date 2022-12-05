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

namespace Evrinoma\AdvantageBundle\Repository\Orm\Advantage;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\AdvantageBundle\Mediator\QueryMediatorInterface;
use Evrinoma\AdvantageBundle\Repository\Advantage\AdvantageRepositoryInterface;
use Evrinoma\AdvantageBundle\Repository\Advantage\AdvantageRepositoryTrait;
use Evrinoma\UtilsBundle\Repository\Orm\RepositoryWrapper;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class AdvantageRepository extends RepositoryWrapper implements AdvantageRepositoryInterface, RepositoryWrapperInterface
{
    use AdvantageRepositoryTrait;

    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
}
