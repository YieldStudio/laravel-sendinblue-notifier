<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use Illuminate\Support\ServiceProvider;

class SendinblueNotifierServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config' => config_path(),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sendinblue.php', 'sendinblue');

        $this->app->bind(SendinblueService::class, function () {
            $identifier = config('sendinblue.identifier');
            $key = config('sendinblue.key');
            $emailFrom = config('sendinblue.emailFrom');
            $smsFrom = config('sendinblue.smsFrom');
            $options = config('sendinblue.options', []);

            $instance = new SendinblueService($identifier, $key, $options);

            if (filled($emailFrom)) {
                $instance->setEmailFrom($emailFrom);
            }

            if (filled($smsFrom)) {
                $instance->setSmsFrom($smsFrom);
            }

            return $instance;
        });
    }

    public function provides(): array
    {
        return [SendinblueService::class];
    }
}
