<?php

namespace App\Services;

use App\ValueObjects\EmailAddress;
use App\Helpers\EmailTypos;

class EmailValidatorService
{
    protected array $tempDomains;

    public function __construct()
    {
        $this->tempDomains = array_map('strtolower', config('email.temporary_domains', []));
    }

    public function isTemporary(EmailAddress $email): bool
    {
        return in_array($email->getDomain(), $this->tempDomains);
    }

    public function hasMxRecord(EmailAddress $email): bool
    {
        return checkdnsrr($email->getDomain(), 'MX');
    }

    public function detectTypos(EmailAddress $email): ?string
    {
        return EmailTypos::suggest($email->getDomain());
    }

    public function validate(EmailAddress $email): array
    {
        if ($this->isTemporary($email)) {
            return ['valid' => false, 'message' => 'النطاق غير موثوق'];
        }

        if (! $this->hasMxRecord($email)) {
            return ['valid' => false, 'message' => 'النطاق لا يستقبل البريد الإلكتروني'];
        }

        if ($suggest = $this->detectTypos($email)) {
            $corrected = str_replace($email->getDomain(), $suggest, $email->getAddress());
            return ['valid' => false, 'message' => "هل تقصد: ".$corrected."؟"];
        }

        return ['valid' => true];
    }
}
