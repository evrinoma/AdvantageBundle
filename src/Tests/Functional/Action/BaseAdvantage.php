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

namespace Evrinoma\AdvantageBundle\Tests\Functional\Action;

use Evrinoma\AdvantageBundle\Dto\AdvantageApiDto;
use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Tests\Functional\Helper\BaseAdvantageTestTrait;
use Evrinoma\AdvantageBundle\Tests\Functional\ValueObject\Advantage\Active;
use Evrinoma\AdvantageBundle\Tests\Functional\ValueObject\Advantage\Id;
use Evrinoma\AdvantageBundle\Tests\Functional\ValueObject\Advantage\Name;
use Evrinoma\AdvantageBundle\Tests\Functional\ValueObject\Advantage\Url;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BaseAdvantage extends AbstractServiceTest implements BaseAdvantageTestInterface
{
    use BaseAdvantageTestTrait;

    public const API_GET = 'evrinoma/api/advantage';
    public const API_CRITERIA = 'evrinoma/api/advantage/criteria';
    public const API_DELETE = 'evrinoma/api/advantage/delete';
    public const API_PUT = 'evrinoma/api/advantage/save';
    public const API_POST = 'evrinoma/api/advantage/create';

    protected static function getDtoClass(): string
    {
        return AdvantageApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            AdvantageApiDtoInterface::ID => Id::default(),
            AdvantageApiDtoInterface::TITLE => Name::default(),
            AdvantageApiDtoInterface::POSITION => Active::value(),
            AdvantageApiDtoInterface::BODY => Url::default(),
        ];
    }

    public function actionPost(): void
    {
        $this->createAdvantage();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(), AdvantageApiDtoInterface::POSITION => Active::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(), AdvantageApiDtoInterface::ID => Id::value(), AdvantageApiDtoInterface::POSITION => Active::block(), AdvantageApiDtoInterface::TITLE => Name::wrong()]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria([AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(), AdvantageApiDtoInterface::POSITION => Active::value(), AdvantageApiDtoInterface::ID => Id::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(), AdvantageApiDtoInterface::POSITION => Active::delete()]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([AdvantageApiDtoInterface::DTO_CLASS => static::getDtoClass(), AdvantageApiDtoInterface::POSITION => Active::delete(), AdvantageApiDtoInterface::TITLE => Name::value()]);
        $this->testResponseStatusOK();
        Assert::assertCount(2, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::POSITION, $find[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::POSITION]);

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::DELETED, $delete[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::POSITION]);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault([AdvantageApiDtoInterface::ID => Id::value(), AdvantageApiDtoInterface::TITLE => Name::value()]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::ID]);
        Assert::assertEquals(Name::value(), $updated[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::TITLE]);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::empty());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([AdvantageApiDtoInterface::ID => Id::wrong(), AdvantageApiDtoInterface::TITLE => Name::wrong()]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createAdvantage();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([AdvantageApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::ID], AdvantageApiDtoInterface::TITLE => Name::empty()]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([AdvantageApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][AdvantageApiDtoInterface::ID], AdvantageApiDtoInterface::BODY => BODY::empty()]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createAdvantage();
        $this->testResponseStatusCreated();
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankName();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankUrl();
        $this->testResponseStatusUnprocessable();
    }
}
