<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Responses\ModelResponseInterface;
use App\Models\Traits\PluralTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @property int      $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property string   $title
 * @property string   $description
 * @property int      $start_price
 * @property int      $bet_step
 * @property string   $deadline
 * @property int      $category_id
 * @property int      $user_id
 * @property string   $image_path
 *
 * @property Bet[]    $bets
 * @property Category $category
 */
final class Lot extends Model implements ModelResponseInterface
{
    use PluralTrait;

    /**
     * @var string
     */
    public const IMAGE_KEY = 'image';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lots';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_price',
        'bet_step',
        'deadline',
        'category_id',
        'user_id',
        'image_path',
    ];

    /**
     * Get the bets for the lot.
     */
    /**
     * @return HasMany
     */
    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class, 'lot_id', 'id');
    }

    /**
     * Get the category associated with the lot.
     */
    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * @return bool
     */
    public function isOwnerCurrentUser(): bool
    {
        return Auth::id() === $this->user_id;
    }

    /**
     * Get the lot's bet step.
     */
    /**
     * @return Attribute
     */
    protected function betStep(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => number_format($value, thousands_separator: ' '),
        );
    }

    /**
     * Get the lot's start price.
     */
    protected function startPrice(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => number_format($value, thousands_separator: ' '),
        );
    }

    public function calcBetStep(): int
    {
        return $this->calcStartPrice() + $this->bet_step;
    }

    public function calcStartPrice(): int | string
    {
        if ($this->bets->count()) {
            return $this->bets->max('amount');
        } else {
            return $this->start_price;
        }
    }

    public function getLastBet(): ?Bet
    {
        return $this->bets[$this->bets->count() - 1] ?? null;
    }

    public function toResponseArray(): array
    {
        return  [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'start_price' => $this->start_price,
            'bet_step'    => $this->bet_step,
            'deadline'    => $this->deadline,
            'category_id' => $this->category_id,
            'image_path'  => $this->image_path,
            'created_at'  => $this->created_at->toDayDateTimeString(),
            'updated_at'  => $this->updated_at->toDayDateTimeString(),
            'user_id'     => $this->user_id,
        ];
    }
}
