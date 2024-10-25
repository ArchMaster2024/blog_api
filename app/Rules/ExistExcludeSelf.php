<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistExcludeSelf implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @param  $tabl
     */
    public function __construct(string $table){}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // TODO: Verificar si esto tiene sentido
        if (DB::table($this->table)->where('id', $value)->exists()) {
            // fail('The :')
        }
    }
}
