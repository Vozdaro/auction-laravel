<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\DTO\Lot\LotStoreDto;
use App\Models\User;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;

final class LotSeeder extends Seeder
{
    private const LOTS = [
        [
            'title'       => 'лот1',
            'description' => 'описание1',
            'start_price' => 10,
            'bet_step'    => 100,
            'deadline'    => '2000-01-01',
            'category_id' => 1,
            'image_path'  => 'lot-1.jpg'
        ],
        [
            'title'       => 'лот2',
            'description' => 'описание2',
            'start_price' => 15,
            'bet_step'    => 150,
            'deadline'    => '2020-01-01',
            'category_id' => 2,
            'image_path'  => 'lot-2.jpg'
        ],
        [
            'title'       => 'лот3',
            'description' => 'описание3',
            'start_price' => 20,
            'bet_step'    => 200,
            'deadline'    => '2030-01-01',
            'category_id' => 3,
            'image_path'  => 'lot-3.jpg'
        ],
    ];

    public function __construct(
        protected LotServiceInterface $lotService,
    ) {
    }

    public function run(): void
    {
        if (!$user = User::first()) {
            return;
        }

        foreach (self::LOTS as $lot) {
            $lotStoreDto = LotStoreDto::fromArray(
                $lot,
                new File(__DIR__ . "/assets/{$lot['image_path']}"),
                $user
            );

            $this->lotService->store($lotStoreDto);
        }
    }
}
