<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Payment extends Model
{
    use HasUuid;

    protected $fillable = [
        'order_id',
        'transaction_id',
        'status_code',
        'type',
        'currency_id',
        'amount',
        'status',
        'completed_at',
        'failed_at',
    ];
}