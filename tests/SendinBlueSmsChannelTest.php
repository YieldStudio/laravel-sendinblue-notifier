<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use SendinBlue\Client\Model\SendTransacSms;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueService;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueSmsChannel;
use YieldStudio\LaravelSendinBlueNotifier\Tests\User;

it('send notification via SendinBlueChannel should call SendinBlueService sendSms method', function () {
    $mock = $this->mock(SendinBlueService::class)->shouldReceive('sendSms')->once();
    $channel = new SendinBlueSmsChannel($mock->getMock());
    $channel->send(new User(), new class extends Notification {
        public function via()
        {
            return [SendinBlueSmsChannel::class];
        }

        public function toSendinBlueSms(Model $notifiable): SendTransacSms
        {
            return new SendTransacSms();
        }
    });
});
