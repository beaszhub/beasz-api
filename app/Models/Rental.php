<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Rental extends Model
{
    use HasUuid;

    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'start_time_at',
        'end_time_at',
        'currency_id',
        'amount',
        'status',
    ];
}
