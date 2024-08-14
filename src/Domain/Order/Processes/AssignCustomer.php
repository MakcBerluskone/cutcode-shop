<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\Models\Order;

class AssignCustomer implements OrderProcessContract
{
    // тут лучше использовать DTO
    public function __construct(protected OrderCustomerDTO $orderCustomerDTO)
    {
    }

    public function handle(Order $order, $next)
    {
        $order->orderCustomer()
            ->create($this->orderCustomerDTO->toArray());

        return $next($order);
    }
}