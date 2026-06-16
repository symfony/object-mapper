<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper\Tests\Fixtures\PrivateParentProperty;

final class MappedChildEntityDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $secret = null,
    ) {
    }
}
