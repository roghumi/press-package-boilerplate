<?php

namespace Roghumi\Press\packagename\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Roghumi\Press\packagename\Providers\PackageServiceProvider;

class TestCase extends TestbenchTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            PackageServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
