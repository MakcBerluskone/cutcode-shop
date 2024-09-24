<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Domain\Order\Actions\NewOrderAction;
use Domain\Order\DTOs\OrderCustomerDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\Order;
use Domain\Order\Models\PaymentMethod;
use Domain\Order\Processes\AssignCustomer;
use Domain\Order\Processes\AssignProducts;
use Domain\Order\Processes\ChangeStateToPending;
use Domain\Order\Processes\CheckProductQuantities;
use Domain\Order\Processes\ClearCart;
use Domain\Order\Processes\DecreaseProductsQuantities;
use Domain\Order\Processes\OrderProcess;
use DomainException;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->user()->get();

        return view('order.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        return view('order.show', [
            'order' => $order->load('items.product'),
        ]);
    }

    public function create()
    {
        $items = cart()->items();

        if ($items->isEmpty()) {
            throw new DomainException('Корзина пуста');
        }

        return view('order.create', [
            'items' => $items,
            'payments' => PaymentMethod::query()->get(),
            'deliveries' => DeliveryType::query()->get(),
        ]);
    }

    public function handle(OrderFormRequest $request, NewOrderAction $action): RedirectResponse
    {
        $orderCustomerDTO = OrderCustomerDTO::fromArray($request->get('customer'));

        $order = $action(
            OrderDTO::make(...$request->only('payment_method_id', 'delivery_type_id', 'password')),
            $orderCustomerDTO,
            $request->boolean('create_account')
        );

        (new OrderProcess($order))->processes([
            new CheckProductQuantities(),
            new AssignCustomer($orderCustomerDTO),
            new AssignProducts(),
            new ChangeStateToPending(),
            new DecreaseProductsQuantities(),
            new ClearCart()
        ])->run();

        return redirect()
            ->route('home');
    }
}
