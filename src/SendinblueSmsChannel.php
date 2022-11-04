<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class SendinblueSmsChannel
{
    public function __construct(protected readonly SendinblueService $sendinblueService)
    {
    }

    /**
     * @throws SendinblueException
     */
    public function send(Model|AnonymousNotifiable $notifiable, Notification $notification): void
    {
        $sms = $notification->toSendinblueSms($notifiable); // @phpstan-ignore-line

        $this->sendinblueService->sendSms($sms);
    }
}
