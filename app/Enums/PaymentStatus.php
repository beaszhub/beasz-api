<?php

namespace App\Enums;

use App\Traits\HasEnumCollection;
use BenSampo\Enum\Enum;

final class PaymentStatus extends Enum
{
    use HasEnumCollection;

    const pending = 'PENDING';
    const completed = 'COMPLETED';
    const failed = 'FAILED';
}