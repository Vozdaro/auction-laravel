<?php

declare(strict_types=1);

namespace App\Services\Lot;

use App\DTO\Lot\LotStoreDto;
use App\Models\Lot;
use App\Services\Lot\Contracts\LotServiceInterface;
use App\Storages\Repositories\Lot\Contracts\LotRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class LotService implements LotServiceInterface
{
    public function __construct(
        private LotRepositoryInterface $lotRepository
    ) {
    }

    private const LOT_PATH_PREFIX = 'public/lots/%s';


    /**
     * @inheritDoc
     */
    public function getAll(bool $paginate = false): Collection|LengthAwarePaginator
    {
        $unmoderatedLotId = intval(Lot::query()
            ->where('user_id', Auth::id())
            ->where('is_moderated', '0')
            ->first()
            ?->user_id);

        if (Auth::id() === $unmoderatedLotId && Auth::user()->is_admin == 0) {
            $query = Lot::where('is_moderated', 1);
            $query->orWhere('user_id', Auth::id());
            return $paginate
                ? $query->paginate(config('app.pagination.per_page'))
                : $query->get();
        }

        if (!Auth::check() || Auth::user()->is_admin == 0) {
            $query = Lot::where('is_moderated', 1);
            return $paginate
                ? $query->paginate(config('app.pagination.per_page'))
                : $query->get();
        }

        return $paginate
            ? Lot::paginate(config('app.pagination.per_page'))
            : Lot::all();
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryId(int $id): Collection
    {
        return Lot::where('category_id', '=', $id)->get();
    }

    /**
     * @inheritDoc
     */
    public function store(LotStoreDto $lotStoreDto): ?Lot
    {
        $pathPrefix = sprintf(self::LOT_PATH_PREFIX, $lotStoreDto->user->id);

        if ($lotStoreDto->image instanceof UploadedFile) {
            $imagePath = $lotStoreDto->image->store($pathPrefix);
        } else {
            $imagePath = Storage::putFile($pathPrefix, $lotStoreDto->image);
        }

        return Lot::create([
            'title'        => $lotStoreDto->title,
            'description'  => $lotStoreDto->description,
            'start_price'  => $lotStoreDto->startPrice,
            'bet_step'     => $lotStoreDto->betStep,
            'deadline'     => $lotStoreDto->deadline,
            'is_moderated' => $lotStoreDto->isModerated,
            'category_id'  => $lotStoreDto->categoryId,
            'user_id'      => $lotStoreDto->user->id,
            'image_path'   => $imagePath,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getLotBySearchQuery($q): Collection
    {
        return Lot::whereLike('title', "%$q%")->get();
    }

    /**
     * @param int $id
     * @return Lot|null
     */
    public function getOne(int $id): ?Lot
    {
        return $this->lotRepository->get($id);
    }

    /**
     * @inheritDoc
     */
    public function deleteOne(int $lotId): bool
    {
        return $this->lotRepository->destroy($lotId);
    }
}
