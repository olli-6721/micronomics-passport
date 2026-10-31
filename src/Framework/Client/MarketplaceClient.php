<?php

namespace Micronomics\Passport\Framework\Client;

class MarketplaceClient extends AbstractClient
{
    public const string ENTITY_BATTERY_MODEL = "battery-model";

    public function find(string $entityName, string $entityId): ?array
    {
        return [];
    }
}
