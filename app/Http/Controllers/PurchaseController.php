<?php

namespace App\Http\Controllers;

use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect(
            PaymentSystem::create(new PaymentData())
                ->url()
        );
    }

    public function callback(): JsonResponse
    {
        return PaymentSystem::validate()
            ->response();
    }
}
