<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

final class SendinblueSmsMessage
{

    protected string $sender;
    protected string $recipient;
    protected string $content;
    protected string $type = 'transactional';
    protected ?string $tag = null;
    protected ?string $webUrl = null;
    protected bool $unicodeEnabled = true;

    public function getSender(): string
    {
        return $this->sender;
    }

    public function setSender(string $sender): SendinblueSmsMessage
    {
        $this->sender = $sender;
        return $this;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): SendinblueSmsMessage
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): SendinblueSmsMessage
    {
        $this->content = $content;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): SendinblueSmsMessage
    {
        $this->type = $type;
        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): SendinblueSmsMessage
    {
        $this->tag = $tag;
        return $this;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function setWebUrl(string $webUrl): SendinblueSmsMessage
    {
        $this->webUrl = $webUrl;
        return $this;
    }

    public function getUnicodeEnabled(): bool
    {
        return $this->unicodeEnabled;
    }

    public function setUnicodeEnabled(bool $unicodeEnabled): SendinblueSmsMessage
    {
        $this->unicodeEnabled = $unicodeEnabled;
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'sender' => $this->sender,
            'recipient' => $this->recipient,
            'content' => $this->content,
            'type' => $this->type,
            'unicodeEnabled' => $this->unicodeEnabled,
        ];

        if (filled($this->tag)) {
            $data['tag'] =  $this->tag;
        }

        if (filled($this->webUrl)) {
            $data['webUrl'] =  $this->webUrl;
        }

        return $data;
    }
}