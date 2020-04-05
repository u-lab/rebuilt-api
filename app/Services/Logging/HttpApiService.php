<?php

namespace App\Services\Logging;

class HttpApiService
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
    public function record(string $ip, string $message, array $context = []): void
    {
        logs('dailyHttpApi')->notice($this->getMessage($ip, $message), $context);
    }

    /**
     * ログに書き込むメッセージの生成
     *
     * @param string $ip
     * @param string $message
     * @return string
     */
    protected function getMessage(string $ip, string $message): string
    {
        return 'ip: ' . $ip . ',' . $message;
    }
}
