<?php

namespace App\Services\Logging;

class ModelNotFoundService
{
    public function __construct()
    {
    }

    /**
     * ログに書き込む
     *
     * @param string $ip
     * @param string $message
     * @param array $context
     * @return void
     */
    public function record(string $message, array $context = []): void
    {
        logs('dailyMNF')->notice($message, $context);
    }
}
