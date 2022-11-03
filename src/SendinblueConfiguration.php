<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

final class SendinblueConfiguration
{
    protected array $apiKeys = [];
    protected string $host = 'https://api.sendinblue.com/v3';

    public function getApiKey(string $apiKeyIdentifier): string|null
    {
        return $this->apiKeys[$apiKeyIdentifier] ?? null;
    }

    public function setApiKey(string $apiKeyIdentifier, string $key): self
    {
        $this->apiKeys[$apiKeyIdentifier] = $key;

        return $this;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }
}
