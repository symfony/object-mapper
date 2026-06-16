<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper;

/**
 * @internal
 */
trait ClassHierarchyTrait
{
    /**
     * Returns all properties from a class including private properties from parent classes.
     *
     * @return \ReflectionProperty[]
     */
    private function getAllProperties(\ReflectionClass $refl): array
    {
        $properties = [];
        $seenNames = [];

        do {
            foreach ($refl->getProperties() as $property) {
                $name = $property->getName();
                if (isset($seenNames[$name])) {
                    continue;
                }
                $seenNames[$name] = true;
                $properties[] = $property;
            }
        } while ($refl = $refl->getParentClass());

        return $properties;
    }

    /**
     * Gets a property from a class or its parent hierarchy.
     */
    private function getPropertyFromHierarchy(\ReflectionClass $refl, string $propertyName): ?\ReflectionProperty
    {
        do {
            if ($refl->hasProperty($propertyName)) {
                return $refl->getProperty($propertyName);
            }
        } while ($refl = $refl->getParentClass());

        return null;
    }
}
