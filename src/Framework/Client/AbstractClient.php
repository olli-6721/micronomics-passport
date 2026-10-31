<?php

namespace Micronomics\Passport\Framework\Client;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('framework.client')]
abstract class AbstractClient
{
    abstract public function find(string $entityName, string $entityId): ?array;
}
