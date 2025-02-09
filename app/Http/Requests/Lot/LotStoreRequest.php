<?php

declare(strict_types=1);

namespace App\Http\Requests\Lot;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

/**
 * @property string $title
 * @property string $description
 * @property string $start_price
 * @property string $bet_step
 * @property string $deadline
 * @property string $category_id
 */
final class LotStoreRequest extends FormRequest
{
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
        return [
            'title'       => ['required', 'string', 'min:10', 'max:30'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'start_price' => ['required', 'integer', 'min:1', 'max:1000000'],
            'bet_step'    => ['required', 'integer', 'min:1', 'max:1000000'],
            'deadline'    => ['required', 'date'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image'       => ['required', File::image()->max(3 * 1024)->extensions(['png', 'jpeg', 'jpg', 'webm'])],
        ];
    }
}
