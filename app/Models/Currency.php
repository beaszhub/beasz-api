<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasUuid;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'status',
    ];

    public function status()
    {
        return Status::getKey($this->status);
    }

    public function country()
    {
        return $this->hasMany(Country::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
