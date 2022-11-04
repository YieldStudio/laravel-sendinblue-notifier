<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

final class SendinblueSmsMessage
{
    public string $from;
    public string $to;
    public string $content;
    public string $type = 'transactional';
    public ?string $tag = null;
    public ?string $webUrl = null;
    public bool $unicodeEnabled = true;

    public function from(string $from): SendinblueSmsMessage
    {
        $this->from = $from;

        return $this;
    }

    public function to(string $to): SendinblueSmsMessage
    {
        $this->to = $to;

        return $this;
    }

    public function content(string $content): SendinblueSmsMessage
    {
        $this->content = $content;

        return $this;
    }

    public function type(string $type): SendinblueSmsMessage
    {
        $this->type = $type;

        return $this;
    }

    public function tag(string $tag): SendinblueSmsMessage
    {
        $this->tag = $tag;

        return $this;
    }

    public function webUrl(string $webUrl): SendinblueSmsMessage
    {
        $this->webUrl = $webUrl;

        return $this;
    }

    public function unicodeEnabled(bool $unicodeEnabled): SendinblueSmsMessage
    {
        $this->unicodeEnabled = $unicodeEnabled;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'sender' => $this->from,
            'recipient' => $this->to,
            'content' => $this->content,
            'type' => $this->type,
            'unicodeEnabled' => $this->unicodeEnabled,
        ];

        if (filled($this->tag)) {
            $data['tag'] = $this->tag;
        }

        if (filled($this->webUrl)) {
            $data['webUrl'] = $this->webUrl;
        }

        return $data;
    }
}
