<?php

namespace App\Enum;

/**
 * orders status list
 */
enum Status
{
    case IN_PROGRESS;
    case CANCELLED;
    case PLACED;
    case SHIPPED;
}
