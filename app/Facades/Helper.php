<?php

namespace App\Facades;

class Helper
{
    /**
     * client urlを作成する
     *
     * @param string $path
     * @return string
     */
    public static function client_route(string $path): string
    {
        $path = '/'.trim($path, '/');
        $root = config('app.client_url');

        return trim($root.$path, '/');
    }
}
