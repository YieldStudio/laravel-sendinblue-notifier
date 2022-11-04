# laravel-sendinblue-notifier

Easily send Sendinblue transactional email and sms with Laravel notifier.

[![Latest Version](https://img.shields.io/github/release/yieldstudio/laravel-sendinblue-notifier?style=flat-square)](https://github.com/yieldstudio/laravel-sendinblue-notifier/releases)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yieldstudio/laravel-sendinblue-notifier/tests?style=flat-square)](https://github.com/yieldstudio/laravel-sendinblue-notifier/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/yieldstudio/laravel-sendinblue-notifier?style=flat-square)](https://packagist.org/packages/yieldstudio/laravel-sendinblue-notifier)

> L’identifiant de version majeure zéro (0.y.z) est destiné au développement initial. Tout ou partie peut être modifié à tout moment. L’API publique ne devrait pas être considérée comme stable.

## Installation

	composer require yieldstudio/laravel-sendinblue-notifier

## Configure

Just define these environment variables:

```dotenv
SENDINBLUE_IDENTIFIER=
SENDINBLUE_KEY=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
SENDINBLUE_SMS_SENDER=
```

Make sure that MAIL_FROM_ADDRESS is an authenticated email on Sendinblue.

SENDINBLUE_SMS_SENDER is limited to 11 for alphanumeric characters and 15 for numeric characters.

You can publish the configuration file with:

```shell
php artisan vendor:publish --provider="YieldStudio\LaravelSendinblueNotifier\SendinblueNotifierServiceProvider" --tag="config"
```

## Usage

### Send email

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use YieldStudio\LaravelSendinblueNotifier\SendinblueEmailChannel;
use YieldStudio\LaravelSendinblueNotifier\SendinblueEmailMessage;

class OrderConfirmation extends Notification
{
    public function via(): array
    {
        return [SendinblueEmailChannel::class];
    }

    public function toSendinblueEmail($notifiable): SendinblueEmailMessage
    {
        return (new SendinblueEmailMessage())
            ->templateId(1)
            ->to($notifiable->firstname, $notifiable->email)
            ->params(['order_ref' => 'N°0000001']);
    }
}
```

### Send sms

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification
use YieldStudio\LaravelSendinblueNotifier\SendinblueSmsChannel;
use YieldStudio\LaravelSendinblueNotifier\SendinblueSmsMessage;

class OrderConfirmation extends Notification
{
    public function via()
    {
        return [SendinblueSmsChannel::class];
    }

    public function toSendinblueEmail($notifiable): SendinblueSmsMessage
    {
        return (new SendinblueSmsMessage())
            ->from('YIELD')
            ->to('+33626631711')
            ->content('Your order is confirmed.');
    }
}
```

## Unit tests

To run the tests, just run `composer install` and `composer test`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://raw.githubusercontent.com/YieldStudio/.github/main/CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [contact@yieldstudio.fr](mailto:contact@yieldstudio.fr) instead of using the issue tracker.

## Credits

- [David Tang](https://github.com/dtangdev)
- [James Hemery](https://github.com/jameshemery)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
