<?php

use Illuminate\Notifications\Notification;
use SendinBlue\Client\Model\SendSmtpEmail;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueEmailChannel;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueService;
use YieldStudio\LaravelSendinBlueNotifier\Tests\User;

it('send notification via SendinBlueEmailChannel should call SendinBlueService sendEmail method', function () {
    $mock = $this->mock(SendinBlueService::class)->shouldReceive('sendEmail')->once();
    $channel = new SendinBlueEmailChannel($mock->getMock());

    $channel->send(new User(), new class extends Notification {
        public function via()
        {
            return [SendinBlueEmailChannel::class];
        }

        public function toSendinBlueEmail(User $notifiable): SendSmtpEmail
        {
            return new SendSmtpEmail();
        }
    });
});
