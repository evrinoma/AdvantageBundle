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
            AdvantageApiDtoInterface::NAME => 'ite',
            AdvantageApiDtoInterface::URL => 'http://ite',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2008-10-23 10:21:50',
        ],
        [
            AdvantageApiDtoInterface::NAME => 'kzkt',
            AdvantageApiDtoInterface::URL => 'http://kzkt',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2015-10-23 10:21:50',
        ],
        [
            AdvantageApiDtoInterface::NAME => 'c2m',
            AdvantageApiDtoInterface::URL => 'http://c2m',
            AdvantageApiDtoInterface::ACTIVE => 'a',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            AdvantageApiDtoInterface::NAME => 'kzkt2',
            AdvantageApiDtoInterface::URL => 'http://kzkt2',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2015-10-23 10:21:50',
            ],
        [
            AdvantageApiDtoInterface::NAME => 'nvr',
            AdvantageApiDtoInterface::URL => 'http://nvr',
            AdvantageApiDtoInterface::ACTIVE => 'b',
            'created_at' => '2010-10-23 10:21:50',
        ],
        [
            AdvantageApiDtoInterface::NAME => 'nvr2',
            AdvantageApiDtoInterface::URL => 'http://nvr2',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2010-10-23 10:21:50',
            ],
        [
            AdvantageApiDtoInterface::NAME => 'nvr3',
            AdvantageApiDtoInterface::URL => 'http://nvr3',
            AdvantageApiDtoInterface::ACTIVE => 'd',
            'created_at' => '2011-10-23 10:21:50',
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
                ->setName($record[AdvantageApiDtoInterface::NAME])
                ->setUrl($record[AdvantageApiDtoInterface::URL])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record[AdvantageApiDtoInterface::ACTIVE]);
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
