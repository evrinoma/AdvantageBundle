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
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait BaseAdvantageTestTrait
{
    protected static function initFiles(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'http');
        file_put_contents($path, 'my_file');

        $file = new UploadedFile($path, 'my_file');

        static::$files = [
            static::getDtoClass() => [
                AdvantageApiDtoInterface::LOGO => $file,
            ],
        ];
    }

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
        $query = static::getDefault([AdvantageApiDtoInterface::TITLE => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankUrl(): array
    {
        $query = static::getDefault([AdvantageApiDtoInterface::BODY => '']);

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
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::TITLE, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::BODY, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::ACTIVE, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::LOGO, $entity);
        Assert::assertArrayHasKey(AdvantageApiDtoInterface::POSITION, $entity);
    }
}
