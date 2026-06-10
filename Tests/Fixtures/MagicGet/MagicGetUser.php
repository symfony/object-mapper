<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper\Tests\Fixtures\MagicGet;

use Symfony\Component\ObjectMapper\Attribute\Map;

#[Map(target: MagicGetUserView::class)]
final class MagicGetUser
{
    public int $id = 1;
    private string $name = 'magic-value';

    public function __get(string $name): mixed
    {
        return $this->$name;
    }

    public function __isset(string $name): bool
    {
        return isset($this->$name);
    }
}
