<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class SendinblueEmailChannel
{
    public function __construct(protected readonly SendinblueService $sendinblueService)
    {
    }

    /**
     * @throws SendinblueException
     */
    public function send(Model|AnonymousNotifiable $notifiable, Notification $notification): void
    {
        $email = $notification->toSendinblueEmail($notifiable); // @phpstan-ignore-line

        $this->sendinblueService->sendEmail($email);
    }
}
