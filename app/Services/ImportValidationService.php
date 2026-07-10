<?php

namespace App\Services;

class ImportValidationService
{
    public static function validate(array $data): array
    {
        $errors = [];

        if (empty($data['full_name'])) {
            $errors[] = 'Full Name is required.';
        }

        if (empty($data['mobile'])) {
            $errors[] = 'Mobile Number is required.';
        }

        if (empty($data['email'])) {
            $errors[] = 'Email is required.';
        }

        return $errors;
    }
}