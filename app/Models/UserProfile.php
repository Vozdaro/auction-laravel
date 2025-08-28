<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Responses\ModelResponseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int      $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property string   $contact_info
 * @property string   $avatar_path
 * @property int      $user_id
 *
 * @property User     $user
 */
final class UserProfile extends Model implements ModelResponseInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contact_info',
        'avatar_path',
        'user_id',
    ];

    /**
     * Get the user associated with the user profile.
     *
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
