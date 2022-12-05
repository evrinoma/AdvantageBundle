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
use Evrinoma\AdvantageBundle\Repository\Advantage\AdvantageQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private AdvantageQueryRepositoryInterface $repository;

    public function __construct(AdvantageQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AdvantageNotFoundException
     */
    public function criteria(AdvantageApiDtoInterface $dto): array
    {
        try {
            $advantage = $this->repository->findByCriteria($dto);
        } catch (AdvantageNotFoundException $e) {
            throw $e;
        }

        return $advantage;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageProxyException
     */
    public function proxy(AdvantageApiDtoInterface $dto): AdvantageInterface
    {
        try {
            if ($dto->hasId()) {
                $advantage = $this->repository->proxy($dto->idToString());
            } else {
                throw new AdvantageProxyException('Id value is not set while trying get proxy object');
            }
        } catch (AdvantageProxyException $e) {
            throw $e;
        }

        return $advantage;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageNotFoundException
     */
    public function get(AdvantageApiDtoInterface $dto): AdvantageInterface
    {
        try {
            $advantage = $this->repository->find($dto->idToString());
        } catch (AdvantageNotFoundException $e) {
            throw $e;
        }

        return $advantage;
    }
}
