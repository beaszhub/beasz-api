<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleType extends Enum
{
    const developer = 'developer';
    const admin = 'admin';
    const merchant = 'merchant';
    const customer = 'customer';
}