<?php

namespace Services\Telegram;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TelegramBotApiTest extends TestCase
{
    /** @test */
    public function it_send_message_success(): void
    {
        Http::fake([
            TelegramBotApi::HOST . '*' => Http::response(['ok' => true]),
        ]);

        $result = TelegramBotApi::sendMessage('', 1, 'Testing');

        $this->assertTrue($result);
    }

    /** @test */
    public function it_send_message_success_by_fake_instance(): void
    {
        TelegramBotApi::fake()
            ->returnTrue();

        $result = app(TelegramBotApiContract::class)::sendMessage('', 1, 'testing');

        $this->assertTrue($result);
    }

    /** @test */
    public function it_send_message_fail_by_fake_instance()
    {
        TelegramBotApi::fake()
            ->returnFalse();
        $result = app(TelegramBotApiContract::class)::sendMessage('', 1, 'testing');

        $this->assertFalse($result);
    }
}