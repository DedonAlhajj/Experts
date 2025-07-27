<?php

namespace App\ValueObjects;

class EmailAddress
{
    public readonly string $address;
    public readonly string $domain;

    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('بريد إلكتروني غير صالح');
        }

        $this->address = strtolower($email);
        $this->domain  = substr(strrchr($email, "@"), 1);
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function __toString(): string
    {
        return $this->getAddress(); // متناسق مع التحسين الجديد
    }
}


