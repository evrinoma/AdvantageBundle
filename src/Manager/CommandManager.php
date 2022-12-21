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
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeCreatedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeRemovedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageCannotBeSavedException;
use Evrinoma\AdvantageBundle\Exception\AdvantageInvalidException;
use Evrinoma\AdvantageBundle\Exception\AdvantageNotFoundException;
use Evrinoma\AdvantageBundle\Factory\Advantage\FactoryInterface;
use Evrinoma\AdvantageBundle\Mediator\CommandMediatorInterface;
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;
use Evrinoma\AdvantageBundle\Repository\Advantage\AdvantageRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private AdvantageRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface           $validator
     * @param AdvantageRepositoryInterface $repository
     * @param FactoryInterface             $factory
     * @param CommandMediatorInterface     $mediator
     */
    public function __construct(ValidatorInterface $validator, AdvantageRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageInvalidException
     * @throws AdvantageCannotBeCreatedException
     * @throws AdvantageCannotBeSavedException
     */
    public function post(AdvantageApiDtoInterface $dto): AdvantageInterface
    {
        $advantage = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $advantage);

        $errors = $this->validator->validate($advantage);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new AdvantageInvalidException($errorsString);
        }

        $this->repository->save($advantage);

        return $advantage;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @return AdvantageInterface
     *
     * @throws AdvantageInvalidException
     * @throws AdvantageNotFoundException
     * @throws AdvantageCannotBeSavedException
     */
    public function put(AdvantageApiDtoInterface $dto): AdvantageInterface
    {
        try {
            $advantage = $this->repository->find($dto->idToString());
        } catch (AdvantageNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $advantage);

        $errors = $this->validator->validate($advantage);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new AdvantageInvalidException($errorsString);
        }

        $this->repository->save($advantage);

        return $advantage;
    }

    /**
     * @param AdvantageApiDtoInterface $dto
     *
     * @throws AdvantageCannotBeRemovedException
     * @throws AdvantageNotFoundException
     */
    public function delete(AdvantageApiDtoInterface $dto): void
    {
        try {
            $advantage = $this->repository->find($dto->idToString());
        } catch (AdvantageNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $advantage);
        try {
            $this->repository->remove($advantage);
        } catch (AdvantageCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
