<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinBlueNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use SendinBlue\Client\ApiException;

class SendinBlueEmailChannel
{
    protected SendinBlueService $sendinBlueService;

    /**
     * Create a new mail channel instance.
     *
     * @param  SendinBlueService  $sendinBlueService
     *
     * @return void
     */
    public function __construct(SendinBlueService $sendinBlueService)
    {
        $this->sendinBlueService = $sendinBlueService;
    }

    /**
     * @param Model $notifiable
     * @param Notification $notification
     *
     * @throws ApiException
     */
    public function send(Model $notifiable, Notification $notification): void
    {
        $sendSmtpEmail = $notification->toSendinBlueEmail($notifiable); // @phpstan-ignore-line

        $this->sendinBlueService->sendEmail($sendSmtpEmail);
    }
}
