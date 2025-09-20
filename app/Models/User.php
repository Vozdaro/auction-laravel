<?php

declare(strict_types=1);

namespace App\Models;

use App\Http\Responses\ModelResponseInterface;
use Database\Seeders\UserSeeder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int         $id
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * @property string      $name
 * @property string      $email
 * @property string      $email_verified_at
 * @property string      $password
 * @property string      $remember_token
 *
 * @property UserProfile $profile
 */
final class User extends Authenticatable implements MustVerifyEmail, ModelResponseInterface
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Get the profile associated with the user.
     *
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    /**
     * Interact with the user's password.
     */
    /**
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }

    public function isAdmin(): bool
    {
        return UserSeeder::ADMIN_EMAIL === $this->email;
    }

    /**
     * @inheritDoc
     */
    public function toResponseArray(): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'password'          => $this->password,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'email_verified_at' => $this->email_verified_at,
            'remember_token'    => $this->remember_token,
        ];
    }
}
