<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinBlueNotifier;

use Illuminate\Support\ServiceProvider;

class SendinBlueNotifierServiceProvider extends ServiceProvider
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

        $this->app->bind(SendinBlueService::class, function () {
            $identifier = config('sendinblue.identifier', 'api-key');
            $key = config('sendinblue.key', '');
            $emailFrom = config('sendinblue.emailFrom');
            $smsFrom = config('sendinblue.smsFrom');
            $options = config('sendinblue.options', []);

            $instance = new SendinBlueService($identifier, $key, $options);

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
        return [SendinBlueService::class];
    }
}
