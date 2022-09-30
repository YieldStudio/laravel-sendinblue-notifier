<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use SendinBlue\Client\ApiException;

class SendinblueEmailChannel
{
    public function __construct(protected readonly SendinblueService $sendinblueService)
    {
    }

    /**
     * @throws ApiException
     */
    public function send(Model $notifiable, Notification $notification): void
    {
        $email = $notification->toSendinblueEmail($notifiable); // @phpstan-ignore-line

        $this->sendinblueService->sendEmail($email);
    }
}
