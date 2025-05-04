<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait PluralTrait
{
    /**
     * Returns the correct plural form
     * Limitations: Integers only
     *
     * Usage example:
     * $remaining_minutes = 5;
     * echo "Я поставил таймер на {$remaining_minutes} " .
     * getNounPluralForm(
     *     $remaining_minutes,
     *     'минута',
     *     'минуты',
     *     'минут'
     * );
     *
     * Result: "Я поставил таймер на 5 минут"
     *
     * @param  float  $num  The number by which we calculate the plural form
     * @param  string $one  Singular form: apple, hour, minute
     * @param  string $two  Plural form for 2, 3, 4: apple, hour, minute
     * @param  string $many Plural form for other numbers
     *
     * @return string       Calculated plural form
     */
    public function getNounPluralForm(float $num, string $one, string $two, string $many): string
    {
        $number = intval($num);
        $mod10 = $number % 10;
        $mod100 = $number % 100;

        return match (true) {
            $mod100 >= 11 && $mod100 <= 20 => $many,
            $mod10 > 5                     => $many,
            $mod10 === 1                   => $one,
            $mod10 >= 2 && $mod10 <= 4     => $two,
            default                        => $many,
        };
    }
}
