<?php

declare(strict_types=1);

namespace YieldStudio\LaravelSendinblueNotifier;

final class SendinblueEmailMessage
{
    protected array $sender = [];
    protected array $to = [];
    protected int $templateId;
    protected ?string $subject = null;
    protected ?array $attachment = null;
    protected ?array $bcc = null;
    protected ?array $cc = null;
    protected ?string $htmlContent = null;
    protected ?string $textContent = null;
    protected ?array $replyTo = null;
    protected ?array $headers = null;
    protected ?array $params = null;

    public function getSender(): array
    {
        return $this->sender;
    }

    public function setSender(array $sender): SendinblueEmailMessage
    {
        $this->sender = $sender;
        return $this;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): SendinblueEmailMessage
    {
        $this->to = [$to];
        return $this;
    }

    public function getBcc(): array
    {
        return $this->bcc;
    }

    public function setBcc(array $bcc): SendinblueEmailMessage
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function getCc(): array
    {
        return $this->cc;
    }

    public function setCc(array $cc): SendinblueEmailMessage
    {
        $this->cc = $cc;
        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): SendinblueEmailMessage
    {
        $this->subject = $subject;
        return $this;
    }

    public function getReplyTo(): array
    {
        return $this->replyTo;
    }

    public function setReplyTo(array $replyTo): SendinblueEmailMessage
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    public function getAttachment(): array
    {
        return $this->attachment;
    }

    public function setAttachment(array $attachment): SendinblueEmailMessage
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): SendinblueEmailMessage
    {
        $this->headers = $headers;
        return $this;
    }

    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    public function setTemplateId(int $templateId): SendinblueEmailMessage
    {
        $this->templateId = $templateId;
        return $this;
    }

    public function getHtmlContent(): string
    {
        return $this->htmlContent;
    }

    public function setHtmlContent(string $htmlContent): SendinblueEmailMessage
    {
        $this->htmlContent = $htmlContent;
        return $this;
    }

    public function getTextContent(): string
    {
        return $this->textContent;
    }

    public function setTextContent(string $textContent): SendinblueEmailMessage
    {
        $this->textContent = $textContent;
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): SendinblueEmailMessage
    {
        $this->params = $params;
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'sender' => $this->sender,
            'to' => $this->to,
            'templateId' => $this->templateId,
            'headers' => $this->headers,
            'params' => $this->params,
        ];

        if (filled($this->subject)) {
            $data['subject'] =  $this->subject;
        }

        if (filled($this->replyTo)) {
            $data['replyTo'] =  $this->replyTo;
        }

        if (filled($this->headers)) {
            $data['headers'] =  $this->headers;
        }

        if (filled($this->params)) {
            $data['params'] =  $this->params;
        }

        if (filled($this->htmlContent)) {
            $data['htmlContent'] =  $this->htmlContent;
        }

        if (filled($this->textContent)) {
            $data['textContent'] =  $this->textContent;
        }

        if (filled($this->cc)) {
            $data['cc'] =  $this->cc;
        }

        if (filled($this->bcc)) {
            $data['bcc'] =  $this->bcc;
        }

        if (filled($this->attachment)) {
            $data['attachment'] =  $this->attachment;
        }

        return $data;
    }
}