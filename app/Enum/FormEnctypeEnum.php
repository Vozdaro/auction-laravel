<?php

declare(strict_types=1);

namespace App\Enum;

enum FormEnctypeEnum: string
{
    case Multipart = 'multipart/form-data';
    case UrlEncoded = 'application/x-www-form-urlencoded';
}
