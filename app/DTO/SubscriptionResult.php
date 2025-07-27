<?php

namespace App\DTO;


class SubscriptionResult
{
    public function __construct(
        public bool $success,
        public string $message,
    ) {}

    public function toFlash(): array
    {
        return [$this->success ? 'success' : 'error', $this->message];
    }
}

