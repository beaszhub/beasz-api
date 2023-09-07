<?php

namespace App\Enums;

use App\Traits\HasEnumCollection;
use BenSampo\Enum\Enum;

final class DepositStatus extends Enum
{
    use HasEnumCollection;

    const outstanding = 'OUTSTANDING';
    const active = 'ACTIVE';
    const refunded = 'REFUNDED';
    const partially_refunded = 'PARTIALLY_REFUNDED';
    const forfeited = 'FORFEITED';
    const pending_refund = 'PENDING_REFUND';
    const expired = 'EXPIRED';
    const hold = 'HOLD';
    const under_review = 'UNDER_REVIEW';
    const cancelled = 'CANCELLED';
}