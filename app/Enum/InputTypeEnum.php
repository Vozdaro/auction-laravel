<?php

declare(strict_types=1);

namespace App\Enum;

enum InputTypeEnum: string
{
    case Date = 'date';
    case Email = 'email';
    case File = 'file';
    case Number = 'number';
    case Password = 'password';
    case Submit = 'submit';
    case Text = 'text';
}
