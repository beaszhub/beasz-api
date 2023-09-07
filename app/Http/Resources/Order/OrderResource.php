<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class OrderResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'order';

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
            'order_reference_no' => $this->order_reference_no,
            'total_amount_display' => $this->currency->symbol . ' ' . $this->total_amount,
            'total_amount' => $this->total_amount,
            'user' => new UserResource(User::find($this->user_id))
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
