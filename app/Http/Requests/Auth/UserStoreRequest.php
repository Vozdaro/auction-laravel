<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @property string $name
 * @property string $email
 * @property string $passwordFlash
 * @property string $passwordFlash_confirmation
 * @property string $contact_info
 */
final class UserStoreRequest extends FormRequest
{
    private const MAX_VARCHAR_LENGHT = 255;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $max = sprintf('max:%d', self::MAX_VARCHAR_LENGHT);

        return [
            'name'                       => ['required', 'string', $max],
            'email'                      => ['required', 'email', $max, 'unique:users,email'],
            'passwordFlash'              => ['required', 'string', $max, Password::defaults(), 'confirmed'],
            'passwordFlash_confirmation' => ['required', 'string'],
            'contact_info'               => ['required', 'string', $max],
        ];
    }
}
