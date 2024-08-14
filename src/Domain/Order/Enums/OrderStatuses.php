<?php

namespace Domain\Order\Enums;

use Domain\Order\Models\Order;
use Domain\Order\States\CancelledOrderState;
use Domain\Order\States\NewOrderState;
use Domain\Order\States\OrderState;
use Domain\Order\States\PaidOrderState;
use Domain\Order\States\PendingOrderState;

enum OrderStatuses: string
{
    case New = 'new';
    case Pending = 'pending';
    case Paid = 'paid';
    case Cancelled = 'cancelled';

    public function createState(Order $order): OrderState
    {
        return match ($this) {
            self::New => new NewOrderState($order),
            self::Pending => new PendingOrderState($order),
            self::Paid => new PaidOrderState($order),
            self::Cancelled => new CancelledOrderState($order),
        };
    }
}
