<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinBlueNotifier;

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

class SendinBlueService
{
    protected Configuration $config;

    protected ?SendSmtpEmailSender $emailFrom = null;

    protected ?string $smsFrom = null;

    public function __construct(string $identifier, string $key, array $options = [])
    {
        if (array_key_exists('emailFrom', $options)) {
            $this->setEmailFrom($options['emailFrom']);
            unset($options['emailFrom']);
        }

        if (array_key_exists('smsFrom', $options)) {
            $this->setSmsFrom($options['smsFrom']);
            unset($options['smsFrom']);
        }

        $this->config = new Configuration();
        $this->config->setApiKey($identifier, $key);
    }

    /**
     * @param SendSmtpEmail $sendSmtpEmail
     *
     * @return CreateSmtpEmail|null
     *
     * @throws ApiException
     */
    public function sendEmail(SendSmtpEmail $sendSmtpEmail, array $options = []): ?CreateSmtpEmail
    {
        $apiInstance = new TransactionalEmailsApi(
            new GuzzleClient(),
            $this->config
        );

        if (!$sendSmtpEmail->getSender()) {
            $sendSmtpEmail->setSender($this->emailFrom);
        } else if (array_key_exists('emailFrom', $options)) {
            $sendSmtpEmail->setSender($options['emailFrom']);
        }

        return $apiInstance->sendTransacEmail($sendSmtpEmail);
    }

    /**
     * @param SendTransacSms $sendTransacSms
     *
     * @return SendSms|null
     *
     * @throws ApiException
     */
    public function sendSms(SendTransacSms $sendTransacSms, array $options = []): ?SendSms
    {
        $apiInstance = new TransactionalSMSApi(
            new GuzzleClient(),
            $this->config
        );

        if (!$sendTransacSms->getSender()) {
            $sendTransacSms->setSender($this->smsFrom);
        } else if (array_key_exists('smsFrom', $options)) {
            $sendTransacSms->setSender($options['smsFrom']);
        }

        return $apiInstance->sendTransacSms($sendTransacSms);
    }

    public function setEmailFrom(array $emailFrom, string $name = ''): static
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