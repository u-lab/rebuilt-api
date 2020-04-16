<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocaleTest extends TestCase
{
    /** @test */
    public function set_locale_from_header()
    {
        $this->withHeaders(['Accept-Language' => 'ja'])
            ->postJson(route('login'));

        $this->assertEquals('ja', $this->app->getLocale());
    }

    /** @test */
    public function set_locale_from_header_short()
    {
        $this->withHeaders(['Accept-Language' => 'en-US'])
            ->postJson(route('login'));

        $this->assertEquals('en', $this->app->getLocale());
    }
}
