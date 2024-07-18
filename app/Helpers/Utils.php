<?php

namespace App\Helpers;
use Carbon\Carbon;

class Utils {

    public static function generateRandomCode($rand, $length): int
    {
        return str_pad(random_int(1, $rand), $length, '0', STR_PAD_LEFT);
    }

    public static function getCurrentDatetime(): string
    {
        $now = Carbon::now('Africa/Lagos');
        return $now->toDateTimeString();
    }
}
