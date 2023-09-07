<?php

namespace App\Http\Resources\Deposit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepositCollection extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'deposits';

    /**
     * Custom wrapper function to wrap the array.
     *
     * @return array
     */
    public function withWrap()
    {
        return [
            self::$wrap => $this->collection
        ];
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->withWrap();
    }
}
