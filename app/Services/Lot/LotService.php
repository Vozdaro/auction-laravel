<?php

declare(strict_types=1);

namespace App\Services\Lot;

use App\DTO\Lot\LotStoreDto;
use App\Models\Lot;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class LotService implements LotServiceInterface
{
    private const LOT_PATH_PREFIX = 'public/lots/%s';
    public function getAll(): Collection
    {
        return Lot::all();
    }

    public function getByCategoryId(int $id): Collection
    {
        return Lot::where('category_id', '=', $id)->get();
    }

    public function store(LotStoreDto $lotStoreDto): ?Lot
    {
        $pathPrefix = sprintf(self::LOT_PATH_PREFIX, $lotStoreDto->user->id);

        if ($lotStoreDto->image instanceof UploadedFile) {
            $imagePath = $lotStoreDto->image->store($pathPrefix);
        } else {
            $imagePath = Storage::putFile($pathPrefix, $lotStoreDto->image);
        }

        return Lot::create([
            'title'       => $lotStoreDto->title,
            'description' => $lotStoreDto->description,
            'start_price' => $lotStoreDto->startPrice,
            'bet_step'    => $lotStoreDto->betStep,
            'deadline'    => $lotStoreDto->deadline,
            'category_id' => $lotStoreDto->categoryId,
            'user_id'     => $lotStoreDto->user->id,
            'image_path'  => $imagePath,
        ]);
    }

    public function getLotBySearchQuery($q): Collection
    {
        return Lot::whereLike('title', "%$q%")->get();
    }
}
