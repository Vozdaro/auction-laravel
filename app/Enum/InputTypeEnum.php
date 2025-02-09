<?php

declare(strict_types=1);

namespace App\Enum;

enum InputTypeEnum: string
{
    case Text = 'text';
    case Number = 'number';
    case File = 'file';
    case Date = 'date';
    case Submit = 'submit';
}
