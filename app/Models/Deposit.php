<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Deposit extends Model
{
    use HasUuid;

    protected $fillable = [
        'user_id',
        'order_id',
        'currency_id',
        'amount',
        'deposited_at',
        'returned_at',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
