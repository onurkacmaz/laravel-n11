<?php

namespace Onurkacmaz\LaravelN11\Tests;

use Orchestra\Testbench\TestCase;
use Onurkacmaz\LaravelN11\LaravelN11ServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelN11ServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
