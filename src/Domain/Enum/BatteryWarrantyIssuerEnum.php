<?php

namespace Micronomics\Passport\Domain\Enum;

enum BatteryWarrantyIssuerEnum : string
{
    case MANUFACTURER = "manufacturer";
    case VEHICLE_OEM = "vehicle_oem";
    case SELLER = "seller";
}
