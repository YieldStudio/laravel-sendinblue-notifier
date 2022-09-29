<?php

use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\CreateSmtpEmail;
use SendinBlue\Client\Model\SendSms;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendTransacSms;
use YieldStudio\LaravelSendinBlueNotifier\SendinBlueService;
use function PHPUnit\Framework\assertInstanceOf;

it('returns a Response instance when the email is sent correctly', function () {
    $sendinBlueService = new SendinBlueService('api-key', 'key', [
        'emailFrom' => [
            'name' => 'John Doe',
            'email' => 'john@doe.fr',
        ]
    ]);

    $message = (new SendSmtpEmail())->setTemplateId(1);
    $result = $sendinBlueService->sendEmail($message);

    assertInstanceOf(CreateSmtpEmail::class, $result);
});

it('returns a SendinBlueException when sending email fails', function () {
    $sendinBlueService = new SendinBlueService('api-key', 'key', [
        'emailFrom' => [
            'name' => 'John Doe',
            'email' => 'john@doe.fr',
        ]
    ]);

    $message = (new SendSmtpEmail())->setTemplateId(1);

    $sendinBlueService->sendEmail($message);
})->throws(ApiException::class);

it('returns a Response instance when the sms is sent correctly', function () {
    $sendinBlueService = new SendinBlueService('api-key', 'key', [
        'smsFrom' => 'SENDER'
    ]);

    $message = (new SendTransacSms())->setRecipient('+33601020304')->setContent('Hello');
    $result = $sendinBlueService->sendSms($message);

    assertInstanceOf(SendSms::class, $result);
});

it('returns a SendinBlueException when sending sms fails', function () {
    $sendinBlueService = new SendinBlueService('key', 'secret', [
        'smsFrom' => 'SENDER',
    ]);

    $message = (new SendTransacSms())->setRecipient('0601020304')->setContent('Hello');
    $sendinBlueService->sendSms($message);
})->throws(ApiException::class);
