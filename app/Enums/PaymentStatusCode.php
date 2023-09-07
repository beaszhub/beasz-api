<?php

namespace App\Enums;

use App\Traits\HasEnumCollection;
use BenSampo\Enum\Enum;

final class PaymentStatusCode extends Enum
{
    use HasEnumCollection;
    
    const success = '00';
    const failed = '11';
    const pending = '22';
}