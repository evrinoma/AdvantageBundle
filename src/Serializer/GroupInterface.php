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

namespace Evrinoma\AdvantageBundle\Serializer;

interface GroupInterface
{
    public const API_POST_ADVANTAGE = 'API_POST_ADVANTAGE';
    public const API_PUT_ADVANTAGE = 'API_PUT_ADVANTAGE';
    public const API_GET_ADVANTAGE = 'API_GET_ADVANTAGE';
    public const API_CRITERIA_ADVANTAGE = self::API_GET_ADVANTAGE;
    public const APP_GET_BASIC_ADVANTAGE = 'APP_GET_BASIC_ADVANTAGE';
}
