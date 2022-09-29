<?php

namespace YieldStudio\LaravelSendinBlueNotifier\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueNotifierServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        $serviceProviders = [
            SendinBlueNotifierServiceProvider::class,
        ];

        return $serviceProviders;
    }
}
