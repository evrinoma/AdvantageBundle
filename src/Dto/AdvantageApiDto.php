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

namespace Evrinoma\AdvantageBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\BodyTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\LogoTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\PositionTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\TitleTrait;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class AdvantageApiDto extends AbstractDto implements AdvantageApiDtoInterface
{
    use ActiveTrait;
    use BodyTrait;
    use IdTrait;
    use LogoTrait;
    use PositionTrait;
    use TitleTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(AdvantageApiDtoInterface::ID);
            $active = $request->get(AdvantageApiDtoInterface::ACTIVE);
            $title = $request->get(AdvantageApiDtoInterface::TITLE);
            $position = $request->get(AdvantageApiDtoInterface::POSITION);
            $body = $request->get(AdvantageApiDtoInterface::BODY);

            $files = ($request->files->has($this->getClass())) ? $request->files->get($this->getClass()) : [];

            try {
                if (\array_key_exists(AdvantageApiDtoInterface::LOGO, $files)) {
                    $logo = $files[AdvantageApiDtoInterface::LOGO];
                } else {
                    $logo = $request->get(AdvantageApiDtoInterface::LOGO);
                    if (null !== $logo) {
                        $logo = new File($logo);
                    }
                }
            } catch (\Exception $e) {
                $logo = null;
            }

            if ($active) {
                $this->setActive($active);
            }
            if ($id) {
                $this->setId($id);
            }
            if ($position) {
                $this->setPosition($position);
            }
            if ($title) {
                $this->setTitle($title);
            }
            if ($body) {
                $this->setBody($body);
            }
            if ($logo) {
                $this->setLogo($logo);
            }
        }

        return $this;
    }
}
