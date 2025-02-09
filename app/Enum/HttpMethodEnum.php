<?php

declare(strict_types=1);

namespace App\Enum;

enum HttpMethodEnum: string
{
    case Get = 'get';
    case Post = 'post';
}
