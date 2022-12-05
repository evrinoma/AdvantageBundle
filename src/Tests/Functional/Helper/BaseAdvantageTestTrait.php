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

namespace Evrinoma\AdvantageBundle\Tests\Functional\Helper;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BaseAdvantageTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createAdvantage(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankName(): array
    {
        $query = static::getDefault([AdvantageApiDtoInterface::NAME => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankUrl(): array
    {
        $query = static::getDefault([AdvantageApiDtoInterface::URL => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkAdvantage($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkAdvantage($entity): void
    {
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::NAME, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::URL, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::ACTIVE, $entity);
    }
}
