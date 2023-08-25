<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasUuid;

    protected $fillable = [
        'product_id',
        'cost',
        'unit',
        'status',
        'currency_id',
    ];

    public function status()
    {
        return Status::getKey($this->status);
    }

    public function displayCost($quantity = 1)
    {
        return $this->currency->symbol . ' ' . number_format($this->calcTotalCost($quantity), 2);
    }

    public function display($quantity = 1)
    {
        return $this->currency->symbol . ' ' . number_format($this->calcTotalPrice($quantity), 2);
    }

    public function calcTotalPrice($quantity = 1)
    {
        return $this->unit * $quantity;
    }

    public function calcTotalCost($quantity = 1)
    {
        return $this->cost * $quantity;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
