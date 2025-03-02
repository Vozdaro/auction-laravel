<?php

declare(strict_types=1);

namespace App\Exceptions\Lot;

use Exception;

final class LotImageRequiredException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
