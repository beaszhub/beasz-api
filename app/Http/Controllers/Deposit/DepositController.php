<?php

namespace App\Http\Controllers\Deposit;

use App\Enums\DepositStatus;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Enums\Message\MessageError;
use App\Libraries\Response;
use App\Http\Resources\Deposit\DepositResource;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Deposit\DepositCollection;
use App\Enums\Message\MessageSuccess;
use App\Libraries\OrderReferenceNo;
use App\Models\Order;
use App\Traits\CheckDepositStatus;
use App\Libraries\Validation;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    use CheckDepositStatus;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function outstanding_deposit_status(Request $request)
    {
        $user = $request->user();

        $resource = array(
            'is_outstanding_deposit' => $this->depositOutstandingStatus($user->id)
        );

        $success = (object) MessageSuccess::RETRIEVED;
        return Response::success($success->code, $resource, trans($success->message, ['attribute' => trans('deposit')]));
    }

    public function outstanding_deposit_payment(Request $request)
    {
        $user = $request->user();

        $deposit = Deposit::from('deposits as d')
            ->select('d.*')
            ->where('d.user_id', $user->id)
            ->where('d.status', DepositStatus::outstanding)
            ->first();

        if (empty($deposit)) {
            $error = (object) MessageError::NOT_FOUND;
            return Response::error($error->code, [], trans($error->message, ['attribute' => trans('deposit')]));
        }

        $deposit = new DepositResource($deposit);

        $success = (object) MessageSuccess::RETRIEVED;
        return Response::success($success->code, $deposit->withWrap(), trans($success->message, ['attribute' => trans('deposit')]));
    }

    public function outstanding_deposit_order(Request $request)
    {
        $user = $request->user();

        $rules = [
            'deposit_id' => ['required'],
            'total_amount' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $validation = Validation::summarize($validator);

            $error = (object) MessageError::INVALID_FORM;
            return Response::error($error->code, $validation, trans($error->message));
        }

        $deposit = Deposit::find($request->input('deposit_id'));

        if (empty($deposit)) {
            $error = (object) MessageError::NOT_FOUND;
            return Response::error($error->code, [], trans($error->message, ['attribute' => trans('deposit')]));
        }

        if (is_null($deposit->order_id)) {
            $order = Order::create([
                'order_reference_no' => OrderReferenceNo::generate(),
                'user_id' => $user->id,
                'currency_id' => $deposit->currency_id,
                'total_amount' => $request->input('total_amount')
            ]);

            $deposit->order_id = $order->id;
            $deposit->save();

            $order = new OrderResource($order);

            $success = (object) MessageSuccess::CREATED;
            return Response::success($success->code, $order->withWrap(), trans($success->message, ['attribute' => trans('deposit')]));
        }

        $order = Order::find($deposit->order_id);

        $order = new OrderResource($order);

        $success = (object) MessageSuccess::RETRIEVED;
        return Response::success($success->code, $order->withWrap(), trans($success->message, ['attribute' => trans('deposit')]));
    }
}
