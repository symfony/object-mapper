<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper\Tests\Fixtures;

use Symfony\Component\VarExporter\LazyGhostTrait;
use Symfony\Component\VarExporter\LazyObjectInterface;

class LazyFoo extends \stdClass implements LazyObjectInterface
{
    use LazyGhostTrait;

    public string $name = 'foo';
}
