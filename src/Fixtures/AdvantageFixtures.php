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

namespace Evrinoma\AdvantageBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\AdvantageBundle\Dto\AdvantageApiDtoInterface;
use Evrinoma\AdvantageBundle\Entity\Advantage\BaseAdvantage;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class AdvantageFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        [
            AdvantageApiDtoInterface::TITLE => 'ite',
            AdvantageApiDtoInterface::BODY => 'http://ite',
            AdvantageApiDtoInterface::POSITION => '1',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2008-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
        ],
        [
            AdvantageApiDtoInterface::TITLE => 'kzkt',
            AdvantageApiDtoInterface::BODY => 'http://kzkt',
            AdvantageApiDtoInterface::POSITION => '2',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2015-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
        ],
        [
            AdvantageApiDtoInterface::TITLE => 'c2m',
            AdvantageApiDtoInterface::BODY => 'http://c2m',
            AdvantageApiDtoInterface::POSITION => '3',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2020-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
        ],
        [
            AdvantageApiDtoInterface::TITLE => 'kzkt2',
            AdvantageApiDtoInterface::BODY => 'http://kzkt2',
            AdvantageApiDtoInterface::POSITION => '1',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2015-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
            ],
        [
            AdvantageApiDtoInterface::TITLE => 'nvr',
            AdvantageApiDtoInterface::BODY => 'http://nvr',
            AdvantageApiDtoInterface::POSITION => '2',
            AdvantageApiDtoInterface::ACTIVE => 'b',
            'created_at' => '2010-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
        ],
        [
            AdvantageApiDtoInterface::TITLE => 'nvr2',
            AdvantageApiDtoInterface::BODY => 'http://nvr2',
            AdvantageApiDtoInterface::POSITION => '3',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2010-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
            ],
        [
            AdvantageApiDtoInterface::TITLE => 'nvr3',
            AdvantageApiDtoInterface::BODY => 'http://nvr3',
            AdvantageApiDtoInterface::POSITION => '1',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2011-10-23 10:21:50',
            AdvantageApiDtoInterface::LOGO => 'PATH://TO_LOGO',
        ],
    ];

    protected static string $class = BaseAdvantage::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = self::getReferenceName();
        $i = 0;

        foreach (static::$data as $record) {
            $entity = new static::$class();
            $entity
                ->setLogo($record[AdvantageApiDtoInterface::LOGO])
                ->setActive($record[AdvantageApiDtoInterface::ACTIVE])
                ->setName($record[AdvantageApiDtoInterface::TITLE])
                ->setUrl($record[AdvantageApiDtoInterface::BODY])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record[AdvantageApiDtoInterface::POSITION]);
            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            ++$i;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::ADVANTAGE_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
