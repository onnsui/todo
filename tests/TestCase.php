<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestHelper\MyRefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MyRefreshDatabase;

    /**
     * Seeder込でリフレッシュするので、拡張
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[MyRefreshDatabase::class])) {
            $this->refreshDatabase();
        }

        return $uses;
    }
}
