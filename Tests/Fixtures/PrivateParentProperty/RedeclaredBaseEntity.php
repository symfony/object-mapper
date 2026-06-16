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

class RedeclaredBaseEntity
{
    /**
     * Intentionally `private` on the parent — the child redeclares `$tag` as
     * `public` so the {@see ClassHierarchyTrait::getAllProperties()} dedup
     * (`seenNames`) is exercised: only the child's version must be returned.
     */
    private string $tag = 'parent-tag';
}
