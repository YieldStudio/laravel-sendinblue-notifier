<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use GuzzleHttp\Client as GuzzleClient;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Api\TransactionalSMSApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\CreateSmtpEmail;
use SendinBlue\Client\Model\SendSms;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendTransacSms;

class SendinblueService
{
    protected Configuration $config;

    protected ?SendSmtpEmailSender $emailFrom = null;

    protected ?string $smsFrom = null;

    public function __construct(string $identifier, string $key, array $options = [])
    {
        if (array_key_exists('emailFrom', $options)) {
            $this->setEmailFrom($options['emailFrom']);
        }

        if (array_key_exists('smsFrom', $options)) {
            $this->setSmsFrom($options['smsFrom']);
        }

        $this->config = new Configuration();
        $this->config->setApiKey($identifier, $key);
    }

    /**
     * @throws ApiException
     */
    public function sendEmail(SendSmtpEmail $email, array $options = []): ?CreateSmtpEmail
    {
        $apiInstance = new TransactionalEmailsApi(
            new GuzzleClient(),
            $this->config
        );

        if (! $email->getSender()) {
            $email->setSender($this->emailFrom);
        } elseif (array_key_exists('emailFrom', $options)) {
            $email->setSender($options['emailFrom']);
        }

        return $apiInstance->sendTransacEmail($email);
    }

    /**
     * @throws ApiException
     */
    public function sendSms(SendTransacSms $sms, array $options = []): ?SendSms
    {
        $apiInstance = new TransactionalSMSApi(
            new GuzzleClient(),
            $this->config
        );

        if (! $sms->getSender()) {
            $sms->setSender($this->smsFrom);
        } elseif (array_key_exists('smsFrom', $options)) {
            $sms->setSender($options['smsFrom']);
        }

        return $apiInstance->sendTransacSms($sms);
    }

    public function setEmailFrom(array $emailFrom): static
    {
        $sendSmtpEmailSender = new SendSmtpEmailSender($emailFrom);

        $this->emailFrom = $sendSmtpEmailSender;

        return $this;
    }

    public function setSmsFrom(string $smsFrom): static
    {
        $this->smsFrom = $smsFrom;

        return $this;
    }
}
