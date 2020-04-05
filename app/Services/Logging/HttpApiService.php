<?php

namespace App\Services\Logging;

class HttpApiService
{
    public function __construct()
    {
    }

    public function record(string $ip, string $message, array $context = []): void
    {
        logs('dailyHttpApi')->notice($this->getMessage($ip, $message), $context);
    }

    protected function getMessage(string $ip, string $message): string
    {
        return 'ip: ' . $ip . ',' . $message;
    }
}
