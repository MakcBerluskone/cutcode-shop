<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\OrderController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class OrderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::controller(OrderController::class)
                ->group(function () {
                    Route::get('/order', 'create')->name('order.create');
                    Route::post('/order', 'handle')->name('order.handle');

                    Route::middleware('auth')->group(function () {
                        Route::get('/orders', 'index')->name('orders');
                        Route::get('/orders/{order}', 'show')->name('orders.show');
                    });
                });
        });
    }
}
