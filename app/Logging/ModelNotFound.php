<?php

namespace App\Logging;

use Monolog\Handler\RotatingFileHandler;

class ModelNotFound
{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof RotatingFileHandler) {
                $sapi = php_sapi_name();
                $handler->setFilenameFormat("{filename}-$sapi-{date}", 'Y-m-d');
            }
        }
    }
}
