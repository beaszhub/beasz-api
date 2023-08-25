<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Enums\Status;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuid;

    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function type()
    {
        return ProductType::getKey((int) $this->type);
    }

    public function status()
    {
        return Status::getKey($this->status);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
