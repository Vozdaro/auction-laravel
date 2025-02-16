<?php

declare(strict_types=1);

namespace App\DTO\Bet;

use App\Http\Requests\Bet\BetStoreRequest;

final readonly class BetStoreDto
{
    public function __construct(
        public int       $amount,
        public int       $lot_id,
        public int       $user_id,
    ) {
    }

    public static function fromRequest(BetStoreRequest $request): self
    {
        return new BetStoreDto(
            intval($request->amount),
            intval($request->lot_id),
            intval($request->user()->id),
        );
    }
}
