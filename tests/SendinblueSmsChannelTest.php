<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use YieldStudio\LaravelSendinblueNotifier\SendinblueService;
use YieldStudio\LaravelSendinblueNotifier\SendinblueSmsChannel;
use YieldStudio\LaravelSendinblueNotifier\SendinblueSmsMessage;
use YieldStudio\LaravelSendinblueNotifier\Tests\User;

it('send notification via SendinblueChannel should call SendinBlueService sendSms method', function () {
    $mock = $this->mock(SendinblueService::class)->shouldReceive('sendSms')->once();
    $channel = new SendinblueSmsChannel($mock->getMock());
    $channel->send(new User(), new class extends Notification {
        public function via()
        {
            return [SendinblueSmsChannel::class];
        }

        public function toSendinblueSms(Model $notifiable): SendinblueSmsMessage
        {
            return new SendinblueSmsMessage();
        }
    });
});
