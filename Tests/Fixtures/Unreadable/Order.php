<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper\Tests\Fixtures\Unreadable;

use Symfony\Component\ObjectMapper\Attribute\Map;

#[Map(target: OrderView::class)]
final class Order
{
    public string $ref = 'o1';
    private array $auditTrail = [];
}
