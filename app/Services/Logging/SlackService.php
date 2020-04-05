<?php
namespace App\Services\Logging;

class SlackService
{
    public function send(string $message, array $context = []): void
    {
        logs('slack')->critical($message, $context);
    }
}
