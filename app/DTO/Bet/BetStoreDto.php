<?php

declare(strict_types=1);

namespace App\DTO\Bet;

use App\Http\Requests\Bet\BetStoreRequest;
use Illuminate\Auth\AuthenticationException;

final readonly class BetStoreDto
{
    /**
     * @param int $amount
     * @param int $lot_id
     * @param int $user_id
     */
    public function __construct(
        public int $amount,
        public int $lot_id,
        public int $user_id,
    ) {
    }

    /**
     * @param BetStoreRequest $request
     * @return self
     * @throws AuthenticationException
     */
    public static function fromRequest(BetStoreRequest $request): self
    {
        if (!$user = $request->user()) {
            throw new AuthenticationException();
        }

        return new self(
            intval($request->amount),
            intval($request->lot_id),
            intval($user->id),
        );
    }
}
