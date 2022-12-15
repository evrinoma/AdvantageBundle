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

namespace Evrinoma\AdvantageBundle\PreValidator;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Exception\AdvantageInvalidException;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkBody($dto)
            ->checkLogo($dto)
            ->checkTitle($dto)
            ->checkPosition($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkBody($dto)
            ->checkLogo($dto)
            ->checkTitle($dto)
            ->checkActive($dto)
            ->checkPosition($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this
            ->checkId($dto);
    }

    private function checkPosition(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasPosition()) {
            throw new AdvantageInvalidException('The Dto has\'t position');
        }

        return $this;
    }

    private function checkTitle(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasTitle()) {
            throw new AdvantageInvalidException('The Dto has\'t title');
        }

        return $this;
    }

    private function checkActive(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasActive()) {
            throw new AdvantageInvalidException('The Dto has\'t active');
        }

        return $this;
    }

    private function checkLogo(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasLogo()) {
            throw new AdvantageInvalidException('The Dto has\'t Logo file');
        }

        return $this;
    }

    private function checkBody(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasBody()) {
            throw new AdvantageInvalidException('The Dto has\'t body');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var AdvantageApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new AdvantageInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
