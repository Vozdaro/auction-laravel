<?php

declare(strict_types=1);

namespace App\Dto\Lot;

use App\Http\Requests\Lot\LotStoreRequest;
use App\Models\User;
use Illuminate\Http\UploadedFile;

final readonly class LotStoreDto
{
    public function __construct(
        public string       $title,
        public string       $description,
        public int          $startPrice,
        public int          $betStep,
        public string       $deadline,
        public int          $categoryId,
        public UploadedFile $image,
        public User         $user,
    ) {
    }

    public static function fromRequest(LotStoreRequest $request, UploadedFile $image, User $user): self
    {
        return new LotStoreDto(
            $request->title,
            $request->description,
            intval($request->start_price),
            intval($request->bet_step),
            $request->deadline,
            intval($request->category_id),
            $image,
            $user,
        );
    }
}
