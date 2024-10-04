<?php

namespace Domain\Order\Payment\Gateways;

use Domain\Order\Contracts\PaymentGatewayContract;
use Domain\Order\Exceptions\PaymentProviderException;
use Domain\Order\Payment\PaymentData;
use Illuminate\Http\JsonResponse;
use Support\ValueObjects\Price;

class YooKassa1 implements PaymentGatewayContract
{
    protected Client $client;

    protected PaymentData $paymentData;

    protected string $errorMessage;

    public function __construct(array $config)
    {
        $this->client = new Client();

        $this->configure($config);
    }

    public function paymentId(): string
    {
        return $this->paymentData->id;
    }

    public function configure(array $config): void
    {
        $this->client->setAuth($config);
    }

    public function data(PaymentData $data): self
    {
        $this->paymentData = $data;

        return $this;
    }

    public function request(): mixed
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function response(): JsonResponse
    {
        try {
            $response = $this->client
                ->capturePayment(
                    $this->payload(),
                    $this->paymentObject()->getId(),
                    $this->idempotenceKey(),
                );
        } catch (\Throwable $exception) {
            $this->errorMessage = $exception->getMessage();

            throw new PaymentProviderException($exception->getMessage());
        }

        return response()->json(
            $response
        );
    }

    public function url(): string
    {
        try {
            $response = $this->client->createPayment(
              $this->payload(),
              $this->idempotenceKey()
            );

            return $response
                ->getConfirmation()
                ->getConfirmationUrl();
        } catch (\Exception $exception) {
            throw new PaymentProviderException($exception->getMessage());
        }
    }

    public function validate(): bool
    {
        $meta = $this->paymentObject()->getMetadata()->toArray();

        $this->data(new PaymentData(
            $this->paymentObject()->getId(),
            $this->paymentObject()->getDescription(),
            '',
            Price::make(
                $this->paymentObject()->getAmount()->getIntegerValue(),
                $this->paymentObject()->getAmount()->getCurrency(),
            ),
            collect($meta)
        ));

        return $this->paymentObject()->getStatus() === PaymentStatus::WAITING_FOR_CAPTURE;
    }

    public function paid(): bool
    {
        // TODO: Implement paid() method.
    }

    public function errorMessage(): string
    {
        // TODO: Implement errorMessage() method.
    }
}