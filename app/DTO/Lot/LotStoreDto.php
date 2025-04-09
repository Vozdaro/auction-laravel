<?php

declare(strict_types=1);

namespace App\DTO\Lot;

use App\Exceptions\Lot\LotImageRequiredException;
use App\Http\Requests\Lot\LotStoreRequest;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

final readonly class LotStoreDto
{
    /**
     * @param string $title
     * @param string $description
     * @param int $startPrice
     * @param int $betStep
     * @param string $deadline
     * @param int $categoryId
     * @param UploadedFile $image
     * @param User $user
     */
    public function __construct(
        public string       $title,
        public string       $description,
        public int          $startPrice,
        public int          $betStep,
        public string       $deadline,
        public int          $categoryId,
        public File|UploadedFile $image,
        public User         $user,
    ) {
    }

    /**
     * @param LotStoreRequest $request
     * @param User $user
     * @return self
     * @throws LotImageRequiredException
     */
    public static function fromRequest(LotStoreRequest $request, User $user): self
    {
        if (!$request->hasFile(Lot::IMAGE_KEY)) {
            throw new LotImageRequiredException();
        }

        return new self(
            $request->title,
            $request->description,
            intval($request->start_price),
            intval($request->bet_step),
            $request->deadline,
            intval($request->category_id),
            $request->allFiles()[Lot::IMAGE_KEY],
            $user,
        );
    }

    public static function fromArray(array $data, File $image, User $user): self
    {
        return new self(
            $data['title'],
            $data['description'],
            $data['start_price'],
            $data['bet_step'],
            $data['deadline'],
            $data['category_id'],
            $image,
            $user,
        );
    }
}
