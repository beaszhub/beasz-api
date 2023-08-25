<?php

namespace App\Enums;

use App\Traits\HasEnumCollection;
use BenSampo\Enum\Enum;

final class ProductType extends Enum
{
    use HasEnumCollection;

    const physical = 1;
    const virtual = 2;
}
