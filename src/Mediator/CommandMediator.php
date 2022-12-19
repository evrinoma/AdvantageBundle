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
use Evrinoma\AdvantageBundle\Model\Advantage\AdvantageInterface;
use Evrinoma\AdvantageBundle\System\FileSystemInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    private FileSystemInterface $fileSystem;

    public function __construct(FileSystemInterface $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function onUpdate(DtoInterface $dto, $entity): AdvantageInterface
    {
        /* @var $dto AdvantageApiDtoInterface */
        $file = $this->fileSystem->save($dto->getLogo());
        $entity
            ->setTitle($dto->getTitle())
            ->setPosition($dto->getPosition())
            ->setBody($dto->getBody())
            ->setLogo($file->getRealPath())
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActive($dto->getActive());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
        $entity
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setActiveToDelete();
    }

    public function onCreate(DtoInterface $dto, $entity): AdvantageInterface
    {
        /* @var $dto AdvantageApiDtoInterface */
        $file = $this->fileSystem->save($dto->getLogo());
        $entity
            ->setTitle($dto->getTitle())
            ->setPosition($dto->getPosition())
            ->setBody($dto->getBody())
            ->setLogo($file->getRealPath())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setActiveToActive();

        return $entity;
    }
}
