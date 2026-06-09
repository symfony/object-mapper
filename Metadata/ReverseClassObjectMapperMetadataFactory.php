<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\ObjectMapper\Metadata;

use Symfony\Component\ObjectMapper\Attribute\Map;

/**
 * Maps classes based on attributes found on the target's properties.
 *
 * @author Florent Blaison <florent.blaison@gmail.com>
 */
final class ReverseClassObjectMapperMetadataFactory implements ObjectMapperMetadataFactoryInterface
{
    /**
     * @var array<string, list<Mapping>>
     */
    private array $attributesCache = [];

    /**
     * @param array<class-string, class-string|list<class-string>> $classMap Targets for a given source must be unique
     */
    public function __construct(
        private readonly ObjectMapperMetadataFactoryInterface $objectMapperMetadataFactory,
        private readonly array $classMap,
    ) {
    }

    public function create(object $object, ?string $property = null, array $context = []): array
    {
        $class = $object::class;
        $key = $class.($property ? '.'.$property : '');

        if (isset($this->attributesCache[$key])) {
            return $this->attributesCache[$key];
        }

        $mappings = $this->objectMapperMetadataFactory->create($object, $property, $context);
        $targetClasses = (array) ($this->classMap[$class] ?? []);

        if (!$targetClasses) {
            return $mappings;
        }

        if (!$property) {
            foreach ($targetClasses as $targetClass) {
                if (!array_any($mappings, static fn (Mapping $m): bool => $m->target === $targetClass)) {
                    $mappings[] = new Mapping($targetClass);
                }
            }

            return $this->attributesCache[$key] = $mappings;
        }

        foreach ($targetClasses as $targetClass) {
            foreach ((new \ReflectionClass($targetClass))->getProperties() as $reflProperty) {
                foreach ($reflProperty->getAttributes(Map::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                    $map = $attribute->newInstance();
                    if ($map->source !== $property) {
                        continue;
                    }

                    $mappings[] = new Mapping($reflProperty->getName(), $map->source, $map->if, $map->transform, targetClass: $targetClass);
                }
            }
        }

        return $this->attributesCache[$key] = $mappings;
    }
}
