<?php

namespace App\Http\Resources\Deposit;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'deposit';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'amount_display' => $this->currency->symbol.' '.$this->amount,
            'amount' => $this->amount,
            'deposited_at' => $this->deposited_at,
            'returned_at' => $this->returned_at,
            'status' => $this->status,
        ];
    }

    /**
     * Custom wrapper function to wrap the array.
     *
     * @return array
     */
    public function withWrap()
    {
        return [
            self::$wrap => $this->toArray()
        ];
    }
}
