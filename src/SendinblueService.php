<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SendinblueService
{
    protected SendinblueConfiguration $config;

    protected PendingRequest $http;

    protected ?array $emailFrom = null;

    protected ?string $smsFrom = null;

    public function __construct(string $identifier, string $key, array $options = [])
    {
        $this->config = new SendinblueConfiguration();
        $this->config->setApiKey($identifier, $key);

        if (array_key_exists('host', $options)) {
            $this->config->setHost($options['host']);
        }

        if (array_key_exists('emailFrom', $options)) {
            $this->setEmailFrom($options['emailFrom']);
        }

        if (array_key_exists('smsFrom', $options)) {
            $this->setSmsFrom($options['smsFrom']);
        }

        $this->http = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'api-key' => $this->config->getApiKey($identifier),
        ])->baseUrl($this->config->getHost());
    }

    public function sendEmail(SendinblueEmailMessage $email, array $options = []): ?array
    {
        if (! $email->getSender()) {
            $email->setSender($this->emailFrom);
        } elseif (array_key_exists('emailFrom', $options)) {
            $email->setSender($options['emailFrom']);
        }
        $response = $this->http->post('/smtp/email', $email->toArray());

        if (! $response->successful()) {
            throw new SendinblueException('SendinblueService:sendEmail() failed', $response->status());
        }

        return json_decode($response->body(), true);
    }

    public function sendSms(SendinblueSmsMessage $sms, array $options = []): ?array
    {
        if (! $sms->getSender()) {
            $sms->setSender($this->smsFrom);
        } elseif (array_key_exists('smsFrom', $options)) {
            $sms->setSender($options['smsFrom']);
        }

        $response = $this->http->post('/transactionalSMS/sms', $sms->toArray());

        if (! $response->successful()) {
            throw new SendinblueException('SendinblueService:sendSms() failed', $response->status());
        }

        return json_decode($response->body(), true);
    }

    public function setEmailFrom(array $emailFrom): static
    {
        $this->emailFrom = $emailFrom;

        return $this;
    }

    public function setSmsFrom(string $smsFrom): static
    {
        $this->smsFrom = $smsFrom;

        return $this;
    }
}
