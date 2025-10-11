<?php

namespace App\Enum;

use App\Enum\Trait\ArrayableEnumTrait;

enum ReplicationPostfixEnum: string
{
    use ArrayableEnumTrait;

    case Master = 'master';
    case Slave = 'slave';
}
