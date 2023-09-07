<?php

namespace App\Enums;

use App\Traits\HasEnumCollection;
use BenSampo\Enum\Enum;

final class RentalStatus extends Enum
{
    use HasEnumCollection;
    
    const pending = 'PENDING'; // This status indicates that a rental order has been placed but has not yet been confirmed or started. It's typically set when a user reserves a power bank but hasn't picked it up or initiated the rental period.
    const active = 'ACTIVE'; // An active status signifies that the rental order is currently in progress. The user has picked up the power bank, and the rental period is ongoing.
    const completed = 'COMPLETED'; // When the user returns the power bank within the agreed-upon time and in good condition, the rental order is marked as completed. The total cost is calculated, and any applicable deposit is refunded.
    const overdue = 'OVERDUE'; // This status is used when the user fails to return the power bank within the specified rental period. It indicates that the rental is overdue, and additional charges may apply.
    const cancelled = 'CANCELLED'; // If a user cancels a rental order before picking up the power bank or before the rental period begins, the order is marked as canceled. Depending on your policy, a cancellation fee or a portion of the deposit might be retained.
}