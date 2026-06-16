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

use Symfony\Component\ObjectMapper\Attribute\Map;

#[Map(target: ChildEntityDto::class)]
class ChildEntity extends BaseEntity
{
    public function __construct(
        int $id,
        public string $name,
    ) {
        parent::__construct($id);
    }
}
