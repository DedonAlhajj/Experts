<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Services\EmailValidatorService;
use App\ValueObjects\EmailAddress;

class ValidEmail implements ValidationRule
{
    protected EmailValidatorService $validator;

    public function __construct(EmailValidatorService $validator)
    {
        $this->validator = $validator;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $email = new EmailAddress($value);
            $result = $this->validator->validate($email);

            if (!$result['valid']) {
                $fail($result['message']);
            }
        } catch (\InvalidArgumentException $e) {
            $fail($e->getMessage());
        }
    }
}
