<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:reset');
    }
}
