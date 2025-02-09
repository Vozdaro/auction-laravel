<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int    $id
 * @property string $created_at
 * @property string $updated_at
 * @property int    $amount
 * @property int    $user_id
 * @property int    $lot_id
 *
 * @property Lot    $lot
 * @property User   $user
 *
 * @method static Bet|null create(array $data)
 * @method static Collection get()
 * @method static $this where($column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 */
final class Bet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'user_id',
        'lot_id',
    ];

    /**
     * Get the lot associated with the bet.
     */
    public function lot(): HasOne
    {
        return $this->hasOne(Lot::class, 'id', 'lot_id');
    }
    /**
     * Get the user associated with the bet.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the lot's start price.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => number_format($value, thousands_separator: ' '),
        );
    }
}
