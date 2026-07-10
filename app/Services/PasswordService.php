<?php

namespace App\Services;

class PasswordService
{
    /**
     * Generate Default Login Password
     */
    public static function generatePassword(string $name, string $mobile): string
    {
        $name = preg_replace('/[^a-zA-Z]/', '', strtolower($name));

        $letters = substr($name, 0, 4);

        if (strlen($letters) < 4) {
            $letters = str_pad($letters, 4, 'x');
        }

        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        $digits = substr($mobile, -4);

        return $letters . $digits;
    }

    /**
     * Generate Default Transaction Password
     */
    public static function generateTransactionPassword(string $name, string $mobile): string
    {
        $name = preg_replace('/[^a-zA-Z]/', '', strtoupper($name));

        $letters = substr($name, 0, 2);

        if (strlen($letters) < 2) {
            $letters = str_pad($letters, 2, 'X');
        }

        $mobile = preg_replace('/[^0-9]/', '', $mobile);

        $digits = substr($mobile, 0, 4);

        return $letters . $digits;
    }
}