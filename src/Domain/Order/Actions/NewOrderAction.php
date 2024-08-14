<?php

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Models\Order;

class NewOrderAction
{
    // В правильной реализации сюда должен передаваться DTO
    public function __invoke(OrderDTO $orderDTO, OrderCustomerDTO $orderCustomerDTO, bool $createAccount): Order
    {
        $registerAction = app(RegisterNewUserContract::class);

        if ($createAccount) {
            $registerAction(
                NewUserDTO::make(
                    $orderCustomerDTO->fullName(),
                    $orderCustomerDTO->email,
                    $orderDTO->password
                )
            );
        }

        return Order::query()->create([
            'payment_method_id' => $orderDTO->payment_method_id,
            'delivery_type_id' => $orderDTO->delivery_type_id,
        ]);
    }
}