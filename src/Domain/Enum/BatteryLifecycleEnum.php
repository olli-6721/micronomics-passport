<?php

namespace Micronomics\Passport\Domain\Enum;

enum BatteryLifecycleEnum : string
{
    case FIRST_LIFE = 'first_life';
    case SURPLUS = 'surplus';
    case SECOND_LIFE = 'second_life';
}
