<?php

namespace Symfony\Component\ObjectMapper\Tests\Fixtures\ClassMap;

use Symfony\Component\ObjectMapper\Attribute\Map;

#[Map(source: RichDomainUser::class)]
final class RichDomainUserView
{
    #[Map(source: 'id')]
    public int $id;

    #[Map(source: 'username')]
    public string $username;
}
