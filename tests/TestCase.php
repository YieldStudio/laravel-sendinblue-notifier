<?php

namespace YieldStudio\LaravelSendinblueNotifier\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use YieldStudio\LaravelSendinblueNotifier\SendinblueNotifierServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [SendinblueNotifierServiceProvider::class];
    }
}
