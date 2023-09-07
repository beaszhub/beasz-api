<?php

namespace App\Libraries;

use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderReferenceNo {

    public static function generate()
    {
        return Str::random(3) . Carbon::now()->timestamp;
    }
}