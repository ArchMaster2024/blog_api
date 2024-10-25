<?php

namespace App\Validations;

use Illuminate\Support\Facades\DB;

class ExitsRecord
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function ById(int $id, string $table): bool
    {
        $recordExtist = DB::table($table)->where('id', $id)->first();
        if ($recordExtist == null) {
            return false;
        }
        return true;
    }
}
