<?php

namespace App\Services;

class PasswordService
{
    /**
     * Generate Login Password
     * Format:
     * 10 Characters
     * - 1 Uppercase
     * - 1 Lowercase
     * - 1 Number
     * - 1 Special Character
     */
    public static function generatePassword(string $name, string $mobile): string
    {
        return self::buildPassword(
            $name,
            $mobile,
            config('app.key'),
            'LOGIN',
            10
        );
    }

    /**
     * Generate Transaction Password
     * Format:
     * 8 Characters
     * - 1 Uppercase
     * - 1 Lowercase
     * - 1 Number
     * - 1 Special Character
     */
    public static function generateTransactionPassword(string $name, string $mobile): string
    {
        return self::buildPassword(
            $name,
            $mobile,
            config('app.key'),
            'TRANSACTION',
            8
        );
    }

    private static function buildPassword(
        string $name,
        string $mobile,
        string $secret,
        string $type,
        int $length
    ): string {

        $hash = hash_hmac(
            'sha256',
            strtolower(trim($name)) . '|' . preg_replace('/\D/', '', $mobile) . '|' . $type,
            $secret
        );

        $upper = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        $lower = 'abcdefghijkmnopqrstuvwxyz';
        $number = '23456789';
        $special = '@#$%&*!?';

        $password =
            $upper[hexdec(substr($hash, 0, 2)) % strlen($upper)] .
            $lower[hexdec(substr($hash, 2, 2)) % strlen($lower)] .
            $number[hexdec(substr($hash, 4, 2)) % strlen($number)] .
            $special[hexdec(substr($hash, 6, 2)) % strlen($special)];

        $pool = $upper . $lower . $number . $special;

        $i = 8;

        while (strlen($password) < $length) {
            $password .= $pool[
                hexdec(substr($hash, $i, 2)) % strlen($pool)
            ];

            $i += 2;

            if ($i >= strlen($hash) - 2) {
                $hash = hash(
                    'sha256',
                    $hash . $secret
                );
                $i = 0;
            }
        }

        return str_shuffle($password);
    }
}