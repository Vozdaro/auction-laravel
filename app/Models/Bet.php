<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Responses\ModelResponseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int    $id
 * @property string $created_at
 * @property string $updated_at
 * @property int    $amount
 * @property int    $user_id
 * @property int    $lot_id
 * @property bool   $is_wim
 *
 * @property Lot    $lot
 * @property User   $user
 */
final class Bet extends Model implements ModelResponseInterface
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
        'is_win',
    ];

    /**
     * Get the lot associated with the bet.
     */
    /**
     * @return HasOne
     */
    public function lot(): HasOne
    {
        return $this->hasOne(Lot::class, 'id', 'lot_id');
    }

    /**
     * Get the user associated with the bet.
     */
    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function toResponseArray(): array
    {
        return [];
    }
}
