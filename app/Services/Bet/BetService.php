<?php

declare(strict_types=1);

namespace App\Services\Bet;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Services\Bet\Contracts\BetServiceInterface;
use App\Storages\Repositories\Bet\Contracts\BetRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class BetService implements BetServiceInterface
{
    public function __construct(
        private readonly BetRepositoryInterface $betRepository,
    ) {}

    /**
     * @inheritdoc
     */
    public function getAllByUserId($user_id): Collection
    {
        return $this->betRepository->getAll($user_id);
    }

    /**
     * @inheritdoc
     */
    public function store(BetStoreDto $betStoreDto): Bet
    {
        return $this->betRepository->createForConnection($betStoreDto);
    }
}
