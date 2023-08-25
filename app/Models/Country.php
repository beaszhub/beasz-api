<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasUuid;

    protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'status',
        'currency_id'
    ];

    public function status()
    {
        return Status::getKey($this->status);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
