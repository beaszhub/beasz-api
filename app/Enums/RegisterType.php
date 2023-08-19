<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RegisterType extends Enum
{
    const manual = 'MANUAL';
    const phone = 'PHONE';
    const email = 'EMAIL';
    const google = 'GOOGLE';
    const facebook = 'FACEBOOK';
    const apple = 'APPLE';
}