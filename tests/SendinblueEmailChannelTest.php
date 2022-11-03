<?php

use Illuminate\Notifications\Notification;
use YieldStudio\LaravelSendinblueNotifier\SendinblueEmailMessage;
use YieldStudio\LaravelSendinblueNotifier\SendinblueEmailChannel;
use YieldStudio\LaravelSendinblueNotifier\SendinblueService;
use YieldStudio\LaravelSendinblueNotifier\Tests\User;

it('send notification via SendinblueEmailChannel should call SendinBlueService sendEmail method', function () {
    $mock = $this->mock(SendinblueService::class)->shouldReceive('sendEmail')->once();
    $channel = new SendinblueEmailChannel($mock->getMock());

    $channel->send(new User(), new class extends Notification {
        public function via()
        {
            return [SendinblueEmailChannel::class];
        }

        public function toSendinblueEmail(User $notifiable): SendinblueEmailMessage
        {
            return new SendinblueEmailMessage();
        }
    });
});
