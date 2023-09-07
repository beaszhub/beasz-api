<?php

namespace App\Traits;

use App\Models\Deposit;
use App\Enums\DepositStatus;

trait CheckDepositStatus
{
    function depositOutstandingStatus($user_id)
    {
        $deposit = Deposit::from('deposits as d')
            ->select('d.*')
            ->where('d.user_id', $user_id)
            ->where('d.status', DepositStatus::outstanding)
            ->get();

        if (empty($deposit)) return false;
        return true;
    }
}
