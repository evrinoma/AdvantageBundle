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
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeSavedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Exception\AdvantageProxyException;
use Evrinoma\AdvantageBundle\Mediator\QueryMediatorInterface;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;

trait AdvantageRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param AdvantageInterface $advantage
     *
     * @return bool
     *
     * @throws AdvantageCannotBeSavedException
     * @throws ORMException
     */
    public function save(AdvantageInterface $advantage): bool
    {
        try {
            $this->persistWrapped($advantage);
        } catch (ORMInvalidArgumentException $e) {
            throw new AdvantageCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param AdvantageInterface $advantage
     *
     * @return bool
     */
    public function remove(AdvantageInterface $advantage): bool
    {
        $advantage
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActiveToDelete();

        return true;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return array
     *
     * @throws AdvantageNotFoundException
     */
    public function findByCriteria(AdvantageApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $advantages = $this->mediator->getResult($dto, $builder);

        if (0 === \count($advantages)) {
            throw new AdvantageNotFoundException('Cannot find advantage by findByCriteria');
        }

        return $advantages;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws AdvantageNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): AdvantageInterface
    {
        /** @var AdvantageInterface $advantage */
        $advantage = $this->findWrapped($id);

        if (null === $advantage) {
            throw new AdvantageNotFoundException("Cannot find advantage with id $id");
        }

        return $advantage;
    }

    /**
     * @param string $id
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageProxyException
     * @throws ORMException
     */
    public function proxy(string $id): AdvantageInterface
    {
        $advantage = $this->referenceWrapped($id);

        if (!$this->containsWrapped($advantage)) {
            throw new AdvantageProxyException("Proxy doesn't exist with $id");
        }

        return $advantage;
    }
}
