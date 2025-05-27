<?php

declare(strict_types=1);

namespace App\Http\Requests\Bet;

use App\Models\Lot;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $amount
 * @property string $lot_id
 */
final class BetStoreRequest extends FormRequest
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
        $rules = [
            'amount' => ['required', 'integer'],
            'lot_id' => ['required', 'integer', 'exists:lots,id'],
        ];

        if ($lot = $this->getLotById()) {
            $rules['amount'][] = "min:{$lot->calcBetStep()}";
        }

        return $rules;

    }

    /**
     * @return Lot|null
     */
    private function getLotById(): ?Lot
    {
        return Lot::find($this->lot_id)->get()[0] ?? null;
    }
}
